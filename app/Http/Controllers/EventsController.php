<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\CreateEventRequest;
use App\Events;
use App\Http\Gateways\NotificationGateway;
use App\Dashboard;
use App\Repositories\NotificationRepository;
use Config;
use App\Helpers\CommonFunction;

class EventsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req) {
        $user = \Auth::user();
        $restrict_entry_permission = true;
        if ($req->mine) {
            session(['mine' => true]);
            $db = Events::where('user_id', '=', $user->id)
                    ->with('bookings')
                    ->orderBy('start_date', 'desc')
                    ->get();
                    $restrict_entry_permission = false;
        } else {
            session(['mine' => false]);
            $db = Events::orderBy('start_date', 'desc')
                    ->with('bookings')
                    ->get();
        }
        $d = $this::itterateEvents($db);
        $user = (new \App\Http\Gateways\UserGateway())->getUser($user->id);
        return view('pages.events.index')->with([
                    'user' => $user,
                    'events' => $d,
                    'restrict_entry_permission'=>$restrict_entry_permission
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.libraries.create')->with([
                    'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateEventRequest $request) {
        $current_user = \Auth::user();

        $db = new Events(); //::whereId($request->eventid)->first();
        $db->title = $request->title;
        $db->start_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->start_date . " " . $request->start_time)));
        $db->end_date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $request->end_date . " " . $request->end_time)));
        $db->description = $request->description;
        $db->category = ($request->category) ? ' ' : ' ';
        $db->public = ($request->public) ? true : false;
        $db->full_day = false;
        if ($request->hasFile('cover')) {
            if ($request->file('cover')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('cover'), $current_user, 200, 200);
                $db->cover_photo = $fileData['path'];
            }
        }
        if ($request->hasFile('attachments')) {
            if ($request->file('attachments')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('attachments'), $current_user, 250, 250);
                $db->attachments = $fileData['path'];
            }
        }
        $db->cost = $request->cost;
        $db->user_id = $current_user->id;
        $db->save();


        $this::insertEventFilters($request, $db, $current_user);
        $this::createNotificationsForFollowers($current_user, $db);
        $this::eventEntryInDashBoard($db->id, $current_user->id);
        $this::sameCategoryOnEventPost($request, $current_user, $db->id);

        return redirect('/events');
    }

    public function insertEventFilters($request, $question, $user) {
        if (!empty($request->all()['tags'])) {
            $this->createFilter($request->all()['tags'], $user, $question, Config::get('constants.Filter_Type_Tag'));
        }
        if (!empty($request->all()['countries'])) {
            $this->createFilter($request->all()['countries'], $user, $question, Config::get('constants.Filter_Type_Country'));
        }
        if (!empty($request->all()['universities'])) {
            $uniName = array_pluck(\App\University::whereIn('id', $request->all()['universities'])->get(), 'name');
            $this->createFilter($uniName, $user, $question, Config::get('constants.Filter_Type_University'));
        }
        if (!empty($request->all()['courses'])) {
            $coursesName = array_pluck(\App\Course::whereIn('id', $request->all()['courses'])->get(), 'name');
            $this->createFilter($coursesName, $user, $question, Config::get('constants.Filter_Type_Course'));
        }
    }

    public function createFilter($filters, $user, $event, $type) {
        $tags = array();
        foreach ($filters as $filter) {
            array_push($tags, [ 'filter' => $filter,
                'type' => $type,
                'event_id' => $event->id,
                'user_id' => $user->id
            ]);
        }
        return \DB::table('event_filters')->insert($tags);
    }

    public function createNotificationsForFollowers($user, $question) {
        $followers = $user->followers;
        if (!empty($followers)) {
            $follower_ids = array_pluck($followers, 'follower_id');
            ( new NotificationGateway)->toFollowersOnEventPost($user, $follower_ids, $question->id);
        }
    }

    public function eventEntryInDashBoard($eventId, $userId) {
        Dashboard::create([
            'dashboardable_id' => $eventId,
            'dashboardable_type' => 'App\Event',
            'user_id' => $userId,
        ]);
    }

    // $data  = request->all()  , $questionId = $eventId   ,$user = Logged In User
    public function sameCategoryOnEventPost($data, $user, $questionId) {
        $id = $user->id;
        if (!empty($data['universities']) && !empty($data['courses']) && !empty($data['countries'])) {

            $userIdsUniversities = \DB::table('users')
                            ->where('id', '!=', $id)
                            ->whereIn('university_list_id', $data['universities'])
                            ->select('id')->get();
            $course_list_id = \DB::table('users')
                            ->where('id', '!=', $id)
                            ->whereIn('course_list_id', $data['courses'])
                            ->select('id')->get();
            $userIdsCountries = \DB::table('users')
                            ->where('id', '!=', $id)
                            ->whereIn('country', $data['countries'])
                            ->select('id')->get();
            $ids = array_merge(array_pluck($userIdsUniversities, 'id'), array_pluck($course_list_id, 'id'));
            $ids = array_merge($ids, array_pluck($userIdsCountries, 'id'));
            $ids = array_unique($ids);
            $notifications = [];
            foreach ($ids as $id) {
                $notifications[] = [
                    'title' => $user->name . " created a Event in your category",
                    'description' => "",
                    'type' => Config::get('constants.Notification_Type_Event_Post_In_Category'),
                    'notificationable_id' => $questionId,
                    'notificationable_type' => "App\Event",
                    'user_id' => $id,
                    'created_at' => \date('Y-m-d H:i:s'),
                    'updated_at' => \date('Y-m-d H:i:s'),
                ];
            }
            ( new NotificationRepository())->insert($notifications);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $db = Events::whereId($id)->get();
        $d = $this::itterateEvents($db);
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.events.index')->with([
                    'user' => $user,
                    'events' => json_encode($this::prepare_json($d)),
                    'raw_events' => $d,
                    'single' => true,
                    'restrict_entry_permission'=>true
        ]);
    }

    public function getEventWithNotification($id, $notificationId) {
        $notification = \App\Notification::where('id', \decrypt($notificationId))
                ->update(['is_read' => 1]);
        return $this->show($id);
    }

    private function itterateEvents($db) {
        $filtered_data = [];
        $current_user = \Auth::user();
        foreach ($db as $key => $value) {
            // 0 || 0
            if ($value->user_id == $current_user->id) {
                $filtered_data[] = $value;
            } else
            if (!$value->public) {
                if ($this::isPrivateEventValidToDisplay($value)) {
                    $filtered_data[] = $value;
                }
            } else {
                $filtered_data[] = $value;
            }
        }
        return $filtered_data;
    }

    public function isPrivateEventValidToDisplay($db, $user = false) {
        if (!$user)
            $user = \Auth::user();
        $collection = $db['filters'];
        if (!empty($user->university)) {
            $filtered = $collection->where('type', 2);
            if (in_array($user->university, array_pluck($filtered, 'filter'))) {
                return true;
            }
        }
        if (!empty($user->country)) {
            $filtered = $collection->where('type', 1);
            if (in_array($user->country, array_pluck($filtered, 'filter'))) {
                return true;
            }
        }
        if (!empty($user->degree)) {
            $filtered = $collection->where('type', 3);
            if (in_array($user->degree, array_pluck($filtered, 'filter'))) {
                return true;
            }
        }
        return false;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function getEvent(Request $request) {
        $start = $request->start;
        $end = $request->end;
        $query = Events::where('start_date', '>=', $start)->where('end_date', '<=', $end);
        if ($request->session()->get('mine')) {
            $query = $query->where('user_id', '=', \Auth::id());
        }
        $db = $query->get();
        $data = $this::itterateEvents($db);
        $result = $this::prepare_json($data);
        return $result;
    }

    public function modify_entry(Request $request) {
        try {
            $db = Events::whereId($request->eventid)->first();
            if ($request->title)
                $db->title = $request->title;
            if ($request->start)
                $db->start_date = $request->start;
            if ($request->end)
                $db->end_date = $request->end;
            $db->save();
        } catch (Exception $e) {
            return ['status' => 'failed'];
        }
        return ['status' => 'success'];
    }

    public function calendar_delete(Request $request) {
        Events::whereId($request->id)->delete();
        return redirect('/events');
    }

    private function prepare_json($data) {
        $result = [];
        foreach ($data as $key => $value) {
            $temp = array('id' => $value->id, 'start' => $value->start_date, 'end' => $value->end_date, 'title' => $value->title, 'allDay' => $value->full_day);
            $result[] = $temp;
        }
        return $result;
    }

    public function bookEvent($id) {
        $id = \decrypt($id);
        $user = \Auth::user();
        $event = \App\BookEvent::where('event_id', $id)
                ->where('user_id', $user->id)
                ->first();
        if (empty($event)) {
            \App\BookEvent::create([
                'user_id' => $user->id,
                'event_id' => $id
            ]);
        }
        return redirect('/home');
    }

    public function myBookedEvent() {

        $user = \Auth::user();
        $events = \App\BookEvent::where('user_id', $user->id)
                ->with('event')
                ->paginate(10);
        return view('pages.events.bookedEvents')->with([
                    'user' => $user,
                    'events' => $events
        ]);
    }
}
