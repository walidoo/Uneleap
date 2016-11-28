<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CommonFunction;
use App\Dashboard;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $user = (new \App\Http\Gateways\UserGateway())->getUserWithFollowing(\Auth::id());
        $followersIds = array_pluck($user['followings'], 'following_id');
        $followersIds[] = $user->id;
        $dashboard = Dashboard::whereIn('user_id', $followersIds)
                        ->where('dashboardable_type', 'App\Question')
                        ->orderBy('created_at', 'Desc')->paginate(5);
        foreach ($dashboard as &$notification) {
            $question = $notification->dashboardable;
            $notification['item'] = $this->setQuestionsToDisplay($question);
            $notification['href'] = "/question/get/" . \encrypt($notification->dashboardable_id);
            $notification['type'] = 'Question';
        }
        return view('home')->with([
                    'user' => $user,
                    'dashboard' => $dashboard,
        ]);
    }

    public function getLibrariesForHomePage() {
        $user = (new \App\Http\Gateways\UserGateway())->getUserWithFollowing(\Auth::id());
        $followersIds = array_pluck($user['followings'], 'following_id');
        $followersIds[] = $user->id;
        $dashboard = Dashboard::whereIn('user_id', $followersIds)
                ->where('dashboardable_type', 'App\Library')
                ->orderBy('created_at', 'Desc')
                ->paginate(5);
        foreach ($dashboard as &$notification) {
            $notification['href'] = "/library/get/" . \encrypt($notification->dashboardable_id);
            $library = $notification->dashboardable;
            $notification['item'] = $this->setLibrarytoDisplay($library);
            $notification['type'] = 'Library';
        }
        return array('status' => 1, 'data' => view('libraryItems')->with([
                'user' => $user,
                'dashboard' => $dashboard,
            ])->render());
    }

    public function setLibrarytoDisplay($question) {
        if (!empty($question->attachment) && !empty($question->attachment_filename)) {
            if (CommonFunction::isImage($question->attachment_filename)) {
                $question['attachment'] = '<img class="myImage img-responsive pad" src="' . $question->attachment . '" alt="Photo">';
            }
            if (CommonFunction::isAudtio($question->attachment_filename)) {
                $question['attachment'] = '<audio controls>
                <source src="' . $question->attachment . '" type="audio/mpeg">
                Your browser does not support the audio tag.
              </audio>';
            }
            if (CommonFunction::isFile($question->attachment_filename)) {
                $question['attachment'] = '<a  target="_blank" class="img-responsive pad" href="' . $question->attachment . '">' . $question->attachment_filename . '</a>';
            }
        }
        return $question;
    }

    public function setQuestionsToDisplay($question) {

        if (!empty($question->path) && !empty($question->filename)) {
            if (CommonFunction::isImage($question->filename)) {
                $question['attachment'] = '<img class="myImage img-responsive pad" src="' . $question->path . '" alt="Photo">';
            }
            if (CommonFunction::isAudtio($question->filename)) {
                $question['attachment'] = '<audio controls>
                <source src="' . $question->path . '" type="audio/mpeg">
                Your browser does not support the audio tag.
              </audio>';
            }
            if (CommonFunction::isFile($question->filename)) {
                $question['attachment'] = '<a  target="_blank" class="img-responsive pad" href="' . $question->path . '">' . $question->filename . '</a>';
            }
        }
        return $question;
    }

}
