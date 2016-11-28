<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Request as Temp;
use Illuminate\Support\Facades\Input;

class UserController extends Controller {

    public function profile() {
        return (new \App\Http\Gateways\UserGateway())->getProfile();
    }

    public function profileSummary(Request $request) {
        return ( new \App\Http\Gateways\UserGateway())->updateProfileSummary($request->all());
    }

    public function profileExperience(Request $request) {
        return ( new \App\Http\Gateways\UserGateway())->updateProfileExperience($request->all());
    }

    public function profileSkill(Request $request) {
        return ( new \App\Http\Gateways\UserGateway())->createOrUpdateProfileSkill($request->all());
    }

    public function profileSkillDelete(Request $request) {
        return ( new \App\Http\Gateways\UserGateway())->deleteSkill($request->all());
    }

    public function profileUniversity(Request $request) {
        return ( new \App\Http\Gateways\UserGateway())->createOrUpdateProfileUniversity($request->all());
    }

    public function profileEducationDelete(Request $request) {
        return ( new \App\Http\Gateways\UserGateway())->educationDelete($request->all());
    }

    public function profilePicture(Request $request) {
        $this->validate($request, [
            'image' => 'sometimes|image|mimes:jpg,jpeg,png,jpg,gif,svg|max:10048',
            'cover' => 'sometimes|image|mimes:jpg,jpeg,png,jpg,gif,svg|max:10048',
        ]);
        return ( new \App\Http\Gateways\UserGateway())->uploadProfilePicture($request);
    }

    public function helpCenter(Request $request) {
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.user.helpCenter')->with([
                    'user' => $user,
        ]);
    }

    public function openProfileWithNotification($id, $notificationId) {
        $notification = \App\Notification::where('id', \decrypt($notificationId))
                ->update(['is_read' => 1]);
        return $this->openProfile($id);
    }

    public function openProfile($id) {
        $user = (new \App\Http\Gateways\UserGateway())->getUserWithFollow(\Auth::id());
        $guest = (new \App\Http\Gateways\UserGateway())->getUser($id);
//For Auth
        $followStatus = ['message' => 'Follow', 'code' => 1];
        $isUserAllowedToChat = 0;
        $followingRequest = 0;
        if (in_array($id, array_pluck($user['followings'], 'following_id'))) {
            $isUserAllowedToChat = 1;
            $followStatus['message'] = "Following";
            $followStatus['code'] = 0;
        } else if (in_array($id, array_pluck($user['pendingFollowings'], 'following_id'))) {
            $followStatus['message'] = "Request Pending";
            $followStatus['code'] = 0;
        }
        if (in_array($id, array_pluck($user['pendingFollowers'], 'follower_id'))) {
            $followingRequest = 1;
        }
//
        return view('pages.user.publicProfile')->with([
                    'user' => $user,
                    'guest' => $guest,
                    'followStatus' => $followStatus,
                    'followingRequest' => $followingRequest,
                    'isUserAllowedToChat' => $isUserAllowedToChat
        ]);
    }

    public function setting(Request $request) {
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.user.setting')->with([
                    'user' => $user,
        ]);
    }

    public function settingStore(Request $request) {
        $userId = \Auth::id();
        $this->validate($request, [
            'email' => 'required|email|unique:users,email,' . $userId,
            'user_name' => 'sometimes|unique:users,user_name,' . $userId,
            'name' => 'required',
            'country' => 'required',
            'university' => 'required',
            'status' => 'sometimes|integer|between:0,3',
            'privacy' => 'sometimes|integer|between:0,2',
        ]);
        return ( new \App\Http\Gateways\UserGateway())->settingStore($request, $userId);
    }

    public function follow(Request $request) {
        return ( new \App\Http\Gateways\UserGateway())->follow($request->all());
    }

    public function accetpOrRejectFollow() {
        if (!Temp::ajax() || !Temp::has('data')) {
            
        } else {
            $id = Temp::input('data')['id'];
            $status = Temp::input('data')['status'];
            return (new \App\Http\Gateways\UserGateway())->accetpOrRejectFollow($id, $status);
        }
    }

    public function getFollowers() {
        return ( new \App\Http\Gateways\UserGateway())->getFollowers();
    }

    public function getFollowings() {
        return ( new \App\Http\Gateways\UserGateway())->getFollowings();
    }

    public function pendingRequests() {
        return ( new \App\Http\Gateways\UserGateway())->pendingRequests();
    }

    public function activate() {
        $user = \Auth::user();
        return view('pages.user.activate')->with([
                    'user' => $user
        ]);
    }

    public function activatePost() {
        return ( new \App\Http\Gateways\UserGateway())->activateUser();
    }

    public function forgotPassword(Request $request) {
//\App\Helpers\CommonFunction::sendEmail( $request );
        return view('pages.user.forgetPassword');
    }

    public function forgotPasswordSendEmail(Request $request) {
        $this->validate($request, [
            'email' => 'required|email'
        ]);
        $email = $request->email;
        $isExists = \App\User::where('email', $email)->first();
        if (!empty($isExists)) {
            $password = str_random(8);
            $hashed_random_password = \Hash::make($password);
            \App\User::where('email', $email)->update(['password' => $hashed_random_password]);
            \App\Helpers\CommonFunction::forgotPasswordSendEmail($email, $password);
            return redirect('/register');
        } else {
            return view('pages.user.forgetPassword')->with([
                        'error' => "User Does Not Exist"
            ]);
        }
    }

    public function helpCenterWelcome() {
        $user = \Auth::user();
        return view('pages.helpcenter.welcome')->with([
                    'user' => $user
        ]);
    }

    public function helpCenterAccountManagement() {
        $user = \Auth::user();
        return view('pages.helpcenter.accountManagement')->with([
                    'user' => $user
        ]);
    }

    public function helpCenterContactUs() {
        $user = \Auth::user();
        return view('pages.helpcenter.contactUs')->with([
                    'user' => $user
        ]);
    }

    public function helpCenterCookiePolicy() {
        $user = \Auth::user();
        return view('pages.helpcenter.cookiePolicy')->with([
                    'user' => $user
        ]);
    }

    public function helpCenterEventManagement() {
        $user = \Auth::user();
        return view('pages.helpcenter.eventManagement')->with([
                    'user' => $user
        ]);
    }

    public function helpCenterFaq() {
        $user = \Auth::user();
        return view('pages.helpcenter.faq')->with([
                    'user' => $user
        ]);
    }

    public function helpCenterKnowledgeCenter() {
        $user = \Auth::user();
        return view('pages.helpcenter.knowledgeCenter')->with([
                    'user' => $user
        ]);
    }

    public function helpCenterMessagingChatting() {
        $user = \Auth::user();
        return view('pages.helpcenter.messagingChatting')->with([
                    'user' => $user
        ]);
    }

    public function helpCenterPrivacy() {
        $user = \Auth::user();
        return view('pages.helpcenter.privacy')->with([
                    'user' => $user
        ]);
    }

    public function helpCenterTermsConditions() {
        $user = \Auth::user();
        return view('pages.helpcenter.termsConditions')->with([
                    'user' => $user
        ]);
    }

    public function needHelp() {
        return view('pages.helpcenter.needHelp');
    }

    public function termsOfServices() {
        return view('pages.helpcenter.termsOfService');
    }

    public function getFolowers(Request $request) {
        if ($request->ajax()) {
            $user = \Auth::user();
            $followings = $user->followings;
            $page = Input::get('page');
            $term = Input::get('term');
            $resultCount = 25;
            $offset = ($page - 1) * $resultCount;

            if ($user->user_type == 4) {
                $breeds = \App\User::where('name', 'LIKE', '%' . $term . '%')
                                ->where('id', '!=', $user->id)
                                ->orderBy('name')
                                ->skip($offset)
                                ->take($resultCount)->get(['id', \DB::raw('name as text')]);
            } else {
                $ids = array_pluck($followings, 'following_id');
                $breeds = \App\User::where('name', 'LIKE', '%' . $term . '%')
                                ->whereIn('id', $ids)
                                ->where('id', '!=', $user->id)
                                ->orderBy('name')
                                ->skip($offset)
                                ->take($resultCount)->get(['id', \DB::raw('name as text')]);
            }

            $count = Count(\App\User::where('name', 'LIKE', '%' . $term . '%')
                            ->where('id', '!=', $user->id)->orderBy('name')
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

    public function userManageMent() {
        $user = \Auth::user();
        return view('pages.user.userManageMent')->with([
                    'user' => $user
        ]);
    }

    public function updateUserStatus() {
        if (!Temp::ajax() || !Temp::has('data')) {
            
        } else {
            $data = Temp::input('data');
            $data = json_decode($data);
            $userId = $data->userId;
            $status = $data->status;

            $user = (new \App\Http\Gateways\UserGateway())->getUser($userId);
            if ($status == Config::get('constants.User_Status_Suspend')) {
                $user->status = Config::get('constants.User_Status_Suspend');
                $user->save();
            } else if ($status == Config::get('constants.User_Status_Deactivate')) {
                $user->delete();
            } else if ($status == Config::get('constants.User_Status_Active')) {
                $user->status = Config::get('constants.User_Status_Active');
                $user->save();
            } else if ($status == Config::get('constants.User_Status_Terminate')) {
                $user->status = Config::get('constants.User_Status_Terminate');
                $user->save();
            }

            return array("status" => 1);
        }
    }

    public function terminate() {
        $user = \Auth::user();
        return view('pages.user.terminate')->with(['user' => $user]);
    }

    
    public function deleteExperience(Request $request )
    {
        if(!empty($request->all()['data']['exp_id']))
        {
            \App\Experience::where('id',$request->all()['data']['exp_id'])->delete();
        }
        return array('status' => 1);
    }
}
