<?php

namespace App\Http\Gateways;

use App\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Http\Gateways\NotificationGateway;

class UserGateway {

    public function getUserWithFollowing($id) {
        return (new \App\Repositories\UserRepository())->getUserWithFollowing($id);
    }

    public function getUserWithFollowers($id) {
        return (new \App\Repositories\UserRepository())->getUserWithFollowers($id);
    }

    public function deleteNotice($id) {
        \App\Notice::where('id', $id)->delete();
        return array('status' => 1, 'id' => $id);
    }

    public function getUserForProfile($id) {
        return (new \App\Repositories\UserRepository())->getUser($id);
    }

    public function getUserWithFollow($id) {
        return (new \App\Repositories\UserRepository())->getUserWithFollow($id);
    }

    public function getUser($id) {
        return (new \App\Repositories\UserRepository())->getUser($id);
    }

    public function getProfile() {
        $user = ( new \App\Repositories\UserRepository())->getProfile(\Auth::id());
        return view('pages.user.profile')->with([
                    'user' => $user
        ]);
    }

    public function updateProfileSummary($data) {
        $user = \Auth::user();
        ( new \App\Repositories\UserRepository())->updateProfileSummary($data['profile_summary'], $user);
        return redirect('/user_profile');
    }

    public function createOrUpdateProfileSkill($data) {
        $user = \Auth::user();
        $skill = null;
        if (!empty($data['skill_update_key']) && !empty($data['skill_id'])) {
            $skill = (new \App\Repositories\UserRepository())->getSkillById($data['skill_id']);
        }
        $filters = ['name', 'percentage'];
        $filteredData = CommonFunction::filterDataFromRequest($data, $filters);
        $filteredData['user_id'] = $user->id;
        ( new \App\Repositories\UserRepository())->createOrUpdateProfileSkill($filteredData, $skill);
        return redirect('/user_profile');
    }

    public function updateProfileExperience($data) {
        $user = Auth::user();
        $experience = null;
        if (!empty($data['exp_update_key']) && !empty($data['exp_id'])) {
            $experience = (new \App\Repositories\UserRepository())->getExpereinceById($data['exp_id']);
        }
        $filters = ['company_name', 'job_title', 'location', 'project_title', 'description'];
        $filteredData = CommonFunction::filterDataFromRequest($data, $filters);
        $filteredData['date_from'] = \date('F', mktime(0, 0, 0, $data['starting_month'], 10)) . ', ' . $data['starting_year'];
        if (!empty($data['ending_month']) && !empty($data['starting_year'])) {
            $filteredData['date_to'] = \date('F', mktime(0, 0, 0, $data['starting_month'], 10)) . ', ' . $data['starting_year'];
        }
        if (!empty($data['is_currently_working'])) {
            $filteredData['is_currently_working'] = ($data['is_currently_working'] == 'on') ? 1 : 0;
        }
        $filteredData['user_id'] = $user->id;
        ( new \App\Repositories\UserRepository())->addExperience($filteredData, $experience);
        return redirect('/user_profile');
    }

    public function deleteSkill($data) {
        return ( new \App\Repositories\UserRepository())->deleteSkill($data['data']['skill_id']);
    }

    public function createOrUpdateProfileUniversity($data) {
        $user = Auth::user();
        $education = null;
        $filters = ['school_name', 'field_of_study', 'grade', 'starting_year', 'ending_year', 'activities', 'description'];
        $filteredData = CommonFunction::filterDataFromRequest($data, $filters);

        if (!empty($data['education_update_key']) && !empty($data['education_id'])) {
            $education = (new \App\Repositories\UserRepository())->getUniversityById($data['education_id']);
        }
        if (!empty($data['is_current'])) {
            $filteredData['is_current'] = ($data['is_current'] == 'on') ? 1 : 0;
        }
        $filteredData['user_id'] = $user->id;
        ( new \App\Repositories\UserRepository())->createOrUpdateProfileUniversity($filteredData, $education);
        return redirect('/user_profile');
    }

    public function educationDelete($data) {
        return (new \App\Repositories\UserRepository())->educationDelete($data['data']['education_id']);
    }

    public function uploadProfilePicture($request) {
        $user = \Auth::user();
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('image'), $user, 100, 100);
                $data['profile_picture_path'] = $fileData['path'];
                $data['profile_picture_filename'] = $fileData['filename'];
                ( new \App\Repositories\UserRepository())->createOrUpdateUser($data, $user);
            }
        }
        if ($request->hasFile('cover')) {
            if ($request->file('cover')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('cover'), $user, 800, 400);
                $data['profile_cover_path'] = $fileData['path'];
                $data['profile_cover_filename'] = $fileData['filename'];
                ( new \App\Repositories\UserRepository())->createOrUpdateUser($data, $user);
            }
        }
        return redirect('/user_profile');
    }

    public function settingStore($request, $userId) {

        $user = (new \App\Http\Gateways\UserGateway())->getUser($userId);
        $userName = ($request->has('user_name')) ? $request->user_name : NULL;
        if (!empty($request->status)) {
            if ($request->status == Config::get('constants.User_Status_Suspend')) {
                $user->status = Config::get('constants.User_Status_Suspend');
            }
            if ($request->status == Config::get('constants.User_Status_Deactivate')) {
                $user->delete();
                return redirect('/');
            }
        }
        if ($request->has('new_password')) {
            if (!\Hash::check($request->old_password, $user->password)) {
                return view('pages.user.setting')->with([
                            'user' => $user,
                            'password_error' => 'Old Password Does Not Match',
                ]);
            }
            $user->password = \Hash::make($request->new_password);
        }
        if (!empty($request->privacy)) {
            $user->privacy = $request->privacy;
        }
        if (!empty($request->country)) {
            $user->country = $request->country;
        }
        if (!empty($request->university)) {
            $uniName = \App\University::findOrfail($request->university)->name;
            $user->university = $uniName;
            $user->university_list_id = $request->university;
        }
        if (!empty($request->language)) {
            $user->language = $request->language;
        }
        $user->email = $request->email;
        $user->name = $request->name;
        $user->user_name = $userName;
        $user->save();
        return redirect('/home');
    }

    public function getLastFiveMessage() {
        return ( new \App\Repositories\UserRepository())->getLastFiveMessage();
    }

    public function follow($input) {
        $user = \Auth::user();
        $guestId = \decrypt($input['guest_user_id']);
        $status = \decrypt($input['status']);
        $follow = \App\Follower::where('follower_id', $user->id)->where('following_id', $guestId)->first();
        if ($status == 1) {
            \DB::beginTransaction();
            $data = ['follower_id' => $user->id, 'following_id' => $guestId, 'status' => $status, 'attempts' => 0];
            if (!empty($follow)) {
                $data['attempts'] = $follow->attempts + 1;
                $follow->update($data);
            } else {
                $follow = \App\Follower::create($data);
            }
            ( new NotificationGateway())->FollowingRequest($user, $guestId, $follow->id);
            \DB::commit();
        } else if ($status == 0) {
            if (!empty($follow)) {
                $follow->delete();
            }
        }
        return redirect('/user/profile/' . $guestId);
    }

    public function accetpOrRejectFollow($id, $status) {
        $user = \Auth::user();
        $id = \decrypt($id);
        $status = \decrypt($status);
        if ($status == Config::get('constants.FollowApproved')) {
            \DB::beginTransaction();
        }
        $follow = \App\Follower::where('following_id', $user->id)->where('follower_id', $id)->first();
        $follow->status = $status;
        $follow->save();

        if ($status == Config::get('constants.FollowApproved')) {
            ( new NotificationGateway())->acceptFollowingRequest($user, $id, $follow->id);
            \DB::commit();
        }
    }

    public function getFollowers() {
        $user = \Auth::user();
        $followers = \App\Follower::where('following_id', $user->id)
                        ->where('status', Config::get('constants.FollowApproved'))
                        ->with('follower')->paginate(10);
        return view('pages.follow.followers')->with([
                    'user' => $user,
                    'followers' => $followers
        ]);
    }

    public function getFollowings() {
        $user = \Auth::user();
        $followings = \App\Follower::where('follower_id', $user->id)
                        ->where('status', Config::get('constants.FollowApproved'))
                        ->with('following')->paginate(10);
        return view('pages.follow.following')->with([
                    'user' => $user,
                    'followings' => $followings
        ]);
    }

    public function pendingRequests() {
        $user = \Auth::user();
        $followers = \App\Follower::where('following_id', $user->id)
                        ->where('status', Config::get('constants.FollowPending'))
                        ->with('follower')->paginate(10);
        return view('pages.follow.pendingFollowers')->with([
                    'user' => $user,
                    'followers' => $followers
        ]);
    }

    public function activateUser() {
        $user = \Auth::user();
        if($user->status != Config::get('constants.User_Status_Terminate')) {
            $user->status = Config::get('constants.User_Status_Active');
            $user->save();
        }
        return redirect('/home');
    }
}
