<?php

namespace App\Http\Controllers;

use Request as Temp;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\University;
use App\Course;
use App\Helpers\CommonFunction;

class UniversityController extends Controller {

    public function insertUniversities() {
        ini_set('max_execution_time', 1200); //300 seconds = 5 minutes
        \Excel::load('uni.xlsx', function($reader) {
            $reader->each(function($sheet) {
                $sheet->each(function($row) {
                    $uni = \App\University::where('name', $row['name'])->first();
                    if (empty($uni)) {
                        \App\University::create(['name' => $row['name']]);
                    }
                });
            });
        });
    }

    public function insertCourses() {
        ini_set('max_execution_time', 1200); //300 seconds = 5 minutes
        \Excel::load('courses.xlsx', function($reader) {
            $reader->each(function($sheet) {
                $sheet->each(function($row) {
                    if (!empty($row)) {
                        Course::create(['name' => $row]);
                    }
                });
            });
        });
    }

    public function getList(Request $request) {
        if ($request->ajax()) {
            $page = Input::get('page');
            $term = Input::get('term');
            $resultCount = 25;
            $offset = ($page - 1) * $resultCount;
            $breeds = University::where('name', 'LIKE', '%' . $term . '%')->orderBy('name')->skip($offset)
                            ->take($resultCount)->get(['id', \DB::raw('name as text')]);
            $count = Count(University::where('name', 'LIKE', '%' . $term . '%')->orderBy('name')
                            ->get(['id', \DB::raw('name as text')]));
            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;
            $results = array(
                "results" => $breeds,
                "pagination" => array(
                    "more" => $morePages
                )
            );
            return response()->json($results);
        }
    }

    public function getCoursesList(Request $request) {
        if ($request->ajax()) {
            $page = Input::get('page');
            $term = Input::get('term');
            $resultCount = 25;
            $offset = ($page - 1) * $resultCount;
            $breeds = Course::where('name', 'LIKE', '%' . $term . '%')->orderBy('name')->skip($offset)
                            ->take($resultCount)->get(['id', \DB::raw('name as text')]);
            $count = Count(Course::where('name', 'LIKE', '%' . $term . '%')->orderBy('name')
                            ->get(['id', \DB::raw('name as text')]));
            $endCount = $offset + $resultCount;
            $morePages = $count > $endCount;
            $results = array(
                "results" => $breeds,
                "pagination" => array(
                    "more" => $morePages
                )
            );
            return response()->json($results);
        }
    }

    public function basicInfo() {
        $user = \Auth::user();
        return view('pages.university.basicInfo')->with([
                    'user' => $user
        ]);
    }

    public function basicInfoForm() {
        if (!Temp::ajax() || !Temp::has('data')) {
            return array('status' => 0);
        } else {
            $id = Temp::input('data')['id'];
            $university = \App\UniversityInfo::where('university_id', $id)->first();
            $uni = [];
            if (!empty($university)) {
                $uni['name'] = $university->name;
                $uni['email'] = $university->email;
                $uni['phone'] = $university->phone;
                $uni['cover'] = $university->cover;
                $uni['profile'] = $university->profile;
                $uni['address'] = $university->address;
                $uni['description1'] = $university->description1;
                $uni['description2'] = $university->description2;
                $uni['description3'] = $university->description3;
                $uni['website'] = $university->website;
                $uni['tag_line'] = $university->tag_line;
            } else {
                $uni['profile'] = $uni['cover'] = '/afowode@my.fit.edu_back.jpg';
                $uni['address'] = $uni['name'] = $uni['email'] = $uni['phone'] = "";
                $uni['description3'] = $uni['description2'] = $uni['description1'] = $uni['website'] = $uni['tag_line'] = "";
            }
            return array('status' => 1, 'data' => view('pages.university.basicInfoForm')
                        ->with([
                            'uni' => $uni,
                            'universityId' => \encrypt($id),
                        ])
                        ->render());
        }
    }

    public function universityInfoStore(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'website' => 'required',
            'tag_line' => 'required',
            'description1' => 'required',
            'description2' => 'required',
            'description3' => 'required',
            'cover' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'profile' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
        ]);
        return ( new \App\Http\Gateways\UniversityGateway())->universityInfoStore($request);
    }

    public function getUniversityPage($id) {
        $user = \Auth::user();
        $university = \App\UniversityInfo::where('university_id', \decrypt($id))->first();
        return view('pages.university.publicPage')->with([
                    'university' => $university,
                    'user' => $user
        ]);
    }

    public function getStudentOrFacultyPaginator() {
        if (!Temp::ajax() || !Temp::has('data')) {
            return array('status' => 0);
        } else {
            $type = Temp::input('data')['type'];
            $user = \Auth::user();
            $users = \App\User::where('user_type', $type)
                    ->where('university_list_id', $user->university_list_id)
                    ->paginate(10);
            return array('status' => 1,
                'data' => view('pages.university.usersList')->with([
                    'users' => $users
                ])->render()
            );
        }
    }

    public function newsForm() {
        $user = \Auth::user();
        return view('pages.university.newFormUniSelector')->with([
                    'user' => $user
        ]);
    }

    public function getNewsForm() {
        if (!Temp::ajax() || !Temp::has('data')) {
            return array('status' => 0);
        } else {
            $id = Temp::input('data')['id'];
            return array('status' => 1, 'data' => view('pages.university.newForm')->with([
                    'universityId' => \encrypt($id),
                ])->render());
        }
    }

    public function universityNewsStore(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'attachment' => 'sometimes|max:10048',
        ]);
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());

        if ($request->hasFile('attachment')) {
            $mimeType = $request->file('attachment')->getMimeType();
            if (\App\Helpers\CommonFunction::isSupportedMimesType($mimeType)) {
                return ( new \App\Http\Gateways\UniversityGateway)->universityNewsStore($request);
            } else {
                return view('pages.university.newFormUniSelector')->with([
                            'user' => $user,
                            'image_error' => "File Type Not Supported"
                ]);
            }
        }
        return ( new \App\Http\Gateways\UniversityGateway)->universityNewsStore($request);
    }

    public function getUniversityNews() {
        if (!Temp::ajax()) {
            return array('status' => 0);
        } else {
            $user = \Auth::user();
            $news = \App\UniversityNews::where('university_id', $user->university_list_id)
                    ->orderBy('created_at', 'Desc')
                    ->paginate(5);

            foreach ($news as &$notification) {
                if (!empty($notification->attachment) && !empty($notification->filename)) {
                    if (CommonFunction::isImage($notification->filename)) {
                        $notification['attachment'] = '<img class="img-responsive pad" src="' . $notification->attacment . '" alt="Photo">';
                    }
                    if (CommonFunction::isAudtio($notification->filename)) {
                        $notification['attachment'] = '<audio controls>
                <source src="' . $notification->attachment . '" type="audio/mpeg">
                Your browser does not support the audio tag.
              </audio>';
                    }
                    if (CommonFunction::isFile($notification->filename)) {
                        $notification['attachment'] = '<a  target="_blank" class="img-responsive pad" href="' . $notification->attachment . '">' . $notification->filename . '</a>';
                    }
                }
            }
            return array('status' => 1,
                'data' => view('pages.university.news')->with([
                    'news' => $news
                ])->render()
            );
        }
    }

}
