<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Datatables;
use App\User;
use App\Question;
use App\University;
use App\Library;
use App\Feedback;
use DB;
use Request as Temp;

class DatatablesController extends Controller {

    public function getUserManagement() {
        $users = User::where('user_type', '!=', 4)->select('users.*');
        return Datatables::of($users)
                        ->addColumn('action', function ($users) {
                            $selectStart = '<select class="userStatus" name="status">';
                            $selectEnd = '</select>';
                            $s4Selected = $s1Selected = $s2Selected = $s3Selected = '';
                            if ($users->status == 1) {
                                $s1Selected = 'selected="selected"';
                            }
                            else if ($users->status == 2) {
                                $s2Selected = 'selected="selected"';
                            }
                            else if ($users->status == 3) {
                                $s3Selected = 'selected="selected"';
                            }
                            if ($users->status == 4) {
                                $s4Selected = 'selected="selected"';
                            }
                            $id = $users->id;
                            $s1 = '<option ' . $s1Selected . ' value=\'{"userId":"' . $id . '","status":1}\'>Activate</option>';
                            $s2 = '<option ' . $s2Selected . ' value=\'{"userId":"' . $id . '","status":2}\'>Suspend</option>';
                            $s3 = '<option ' . $s3Selected . ' value=\'{"userId":"' . $id . '","status":3}\'>Deactivate</option>';
                            $s4 = '<option ' . $s4Selected . ' value=\'{"userId":"' . $id . '","status":4}\'>Block</option>';
                            $selectEnd = '</select>';
                            return $selectStart . $s1 . $s2 . $s3 . $s4 . $selectEnd;
                        })
                        ->make(true);
    }

    public function getFeedbacks() {
        $posts = Feedback::with('user')->select('feedbacks.*');
        return Datatables::of($posts)
                        ->addColumn('attachment', function ($posts) {
                            return '<a target="_blank" href="' . $posts->attachment . '">' . $posts->filename . '</a>';
                        })
                        ->make(true);
    }

    public function search() {
        $user = ( new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        // return view('pages.search.index')->with([
        //             'user' => $user, 'qq' => $qqq 
        // ]);
        return view('pages.search.index');
    }

    public function get_user_search(Request $request) {
        $user = ( new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        $user_name = $request->input('q');
        $all_users_search = DB::table('users')->where('user_name', 'like', "$user_name%")
                                              ->orWhere('user_name', 'like', "%$user_name%")
                                              ->get();
        return view('pages.search.index')->with([
                                                    'user_search' => $all_users_search,
                                                    'user' => $user
                                                ]);
    }

    public function get_search_question(Request $request) {
        // $user = ( new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        $question_search_key = $request->input('search_val');
        $all_questions_search = DB::table('questions')->where('title', 'like', "$question_search_key%")
                                              ->orWhere('title', 'like', "%$question_search_key%")
                                              ->get();
        foreach( $all_questions_search as $each_questions_search ) {
            $filter_name = Question::find($each_questions_search->id)->filters;
            // print_r($filter_name);
            $each_questions_search->filter_name = $filter_name;
        }
        if($request->ajax()){
           return response()->json(['question_search' =>  $all_questions_search], 200);
        }

    }

    public function get_search_library(Request $request) {
        $user = ( new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        $library_search_key = $request->input('search_val');
        $all_library_search = DB::table('libraries')->where('title', 'like', $library_search_key.'%')
                                                    ->orWhere('title', 'like', "%$library_search_key%")->get();
        if( sizeof( $all_library_search ) == 0 ) {
          $all_library_search = DB::table('libraries')->where('author', 'like', $library_search_key.'%')
                                                    ->orWhere('author', 'like', "%$library_search_key%")->get();  
        }
        foreach( $all_library_search as $each_library_search ) {
            $filter_name = Library::find($each_library_search->id)->filters;
            // print_r($filter_name);
            $each_library_search->filter_name = $filter_name;
        }
        if($request->ajax()){
           return response()->json(['library_search' =>  $all_library_search], 200);
        }
    }

    public function get_search_university(Request $request) {
        $user = ( new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        $university_search_key = $request->input('search_val');
        $all_university_search = DB::table('universities')->where('name', 'like', $university_search_key.'%')
                                                    ->orWhere('name', 'like', "%$university_search_key%")->get();
        foreach( $all_university_search as $each_university_search ) {
            $university_filter_name = University::find($each_university_search->id)->university_info;
            // print_r($filter_name);
            $each_university_search->university_filter_data = $university_filter_name;
        }
        if($request->ajax()){
           return response()->json(['university_search' =>  $all_university_search], 200);
        }
    }


    public function get_search_event(Request $request) {
        $user = ( new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        $event_search_key = $request->input('search_val');
        $all_event_search = DB::table('events')->where('title', 'like', $event_search_key.'%')
                                                    ->orWhere('title', 'like', "%$event_search_key%")->get();
        foreach( $all_event_search as $each_event_search ) {
            $event_filter_name = University::find($each_event_search->id)->filters;
            // print_r($filter_name);
            $each_event_search->event_filter_data = $event_filter_name;
        }
        if($request->ajax()){
           return response()->json(['event_search' =>  $all_event_search], 200);
        }
    }

    //Deprecated
    public function anyData() {
        $users = Datatables::of(User::query())
                        ->addColumn('profile', function ($user) {
                            if (empty($user->profile_picture_path)) {
                                $user->profile_picture_path = '/images/profile.png';
                            }
                            return '<img style="height: 30%;width: 25%;"src="' . $user->profile_picture_path . '">';
                        })->make(true);
        return view('pages.search.index')->with([
                    'user' => $users
        ]);
        // return $users;
    }

    //Deprecated
    public function getPageOnType() {

        if (!Temp::ajax() || !Temp::has('data')) {
            
        } else {
            $id = Temp::input('data')['searchType'];
            if ($id == 1) {
                return array('type' => 1, 'status' => 1, 'data' => view('pages.search.question')->render());
            } else if ($id == 2) {
                return array('type' => 2, 'status' => 1, 'data' => view('pages.search.library')->render());
            } else if ($id == 0) {
                return array('type' => 0, 'status' => 1, 'data' => view('pages.search.user')->render());
            }
        }
    }


    //Deprecated
    public function searchQuestion() {

        $user = \Auth::user();
        return Datatables::of(Question::with('filters')->select('questions.*'))
                        ->addColumn('title', function (Question $question) use ($user) {
                            if ($question->privacy == 1) {
                                return $this->isValidToReturnRowIfQuestionIsPrivate($user, $question, $question->title);
                            }
                            return $question->title;
                        })->addColumn('description', function (Question $question) use ($user) {
                            if ($question->privacy == 1) {
                                return $this->isValidToReturnRowIfQuestionIsPrivate($user, $question, $question->description);
                            }
                            return $question->description;
                        })->addColumn('filters', function (Question $question) use ($user) {
                            if ($question->privacy == 1) {
                                return $this->isValidToReturnRowIfQuestionIsPrivateForTags($user, $question);
                            }
                            return $question->filters->map(function($filter) {
                                        return $filter->filter;
                                    })->implode('<br>');
                        })
                        ->make(true);
    }

    //Deprecated
    public function searchLibrary() {
        $user = \Auth::user();
        return Datatables::of(Library::with('filters')->select('libraries.*'))
                        ->addColumn('author', function (Library $question) use ($user) {
                            if ($question->privacy == 1) {
                                return $this->isValidToReturnRowIfQuestionIsPrivate($user, $question, $question->title);
                            }
                            return $question->title;
                        })
                        ->addColumn('title', function (Library $question) use ($user) {
                            if ($question->privacy == 1) {
                                return $this->isValidToReturnRowIfQuestionIsPrivate($user, $question, $question->title);
                            }
                            return $question->title;
                        })->addColumn('description', function (Library $question) use ($user) {
                            if ($question->privacy == 1) {
                                return $this->isValidToReturnRowIfQuestionIsPrivate($user, $question, $question->description);
                            }
                            return $question->description;
                        })
                        ->addColumn('filters', function (Library $library) use ($user) {
                            if ($library->privacy == 1) {
                                return $this->isValidToReturnRowIfQuestionIsPrivateForTags($user, $library);
                            }
                            return $library->filters->map(function($filter) {
                                        return $filter->filter;
                                    })->implode('<br>');
                        })
                        ->addColumn('profile', function ($library) use ($user) {
                            if ($library->privacy == 1) {
                                return $this->isValidToReturnRowIfLibraryIsPrivateForImage($user, $library);
                            }
                            return '<img style="height: 50%;width: 50%;"src="' . $library->cover . '">';
                        })
                        ->make(true);
    }

    public function isValidToReturnRowIfQuestionIsPrivate($user, $question, $returnData) {
        $collection = $question['filters'];
        if (!empty($user->university)) {
            $filtered = $collection->where('type', 2);
            if (in_array($user->university, array_pluck($filtered, 'filter'))) {
                return $returnData;
            }
        }
        if (!empty($user->country)) {
            $filtered = $collection->where('type', 1);
            if (in_array($user->country, array_pluck($filtered, 'filter'))) {
                return $returnData;
            }
        }
        if (!empty($user->degree)) {
            $filtered = $collection->where('type', 3);
            if (in_array($user->degree, array_pluck($filtered, 'filter'))) {
                return $returnData;
            }
        }
        return;
    }

    public function isValidToReturnRowIfQuestionIsPrivateForTags($user, $question) {
        $collection = $question['filters'];
        if (!empty($user->university)) {
            $filtered = $collection->where('type', 2);
            if (in_array($user->university, array_pluck($filtered, 'filter'))) {
                return $collection->map(function($filter) {
                            return $filter->filter;
                        })->implode('<br>');
            }
        }
        if (!empty($user->country)) {
            $filtered = $collection->where('type', 1);
            if (in_array($user->country, array_pluck($filtered, 'filter'))) {
                return $collection->map(function($filter) {
                            return $filter->filter;
                        })->implode('<br>');
            }
        }
        if (!empty($user->degree)) {
            $filtered = $collection->where('type', 3);
            if (in_array($user->degree, array_pluck($filtered, 'filter'))) {
                return $collection->map(function($filter) {
                            return $filter->filter;
                        })->implode('<br>');
            }
        }
        return;
    }

    public function isValidToReturnRowIfLibraryIsPrivateForImage($user, $question) {
        $collection = $question['filters'];
        if (!empty($user->university)) {
            $filtered = $collection->where('type', 2);
            if (in_array($user->university, array_pluck($filtered, 'filter'))) {
                return '<img style="height: 50%;width: 50%;"src="' . $question->cover . '">';
            }
        }
        if (!empty($user->country)) {
            $filtered = $collection->where('type', 1);
            if (in_array($user->country, array_pluck($filtered, 'filter'))) {
                return '<img style="height: 50%;width: 50%;"src="' . $question->cover . '">';
            }
        }
        if (!empty($user->degree)) {
            $filtered = $collection->where('type', 3);
            if (in_array($user->degree, array_pluck($filtered, 'filter'))) {
                return '<img style="height: 50%;width: 50%;"src="' . $question->cover . '">';
            }
        }
        return;
    }

}
