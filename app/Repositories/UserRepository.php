<?php

namespace App\Repositories;

use App\User;
use App\Experience;
use App\Skill;
use App\Education;
use App\Chat;
use App\Feedback;
use App\Notice;

class UserRepository {

    public function getUserWithFollow($id) {
        return User::where('id', $id)->with(['skills', 'educations', 'followings', 'followers', 'pendingFollowings','pendingFollowers'])->first();
    }

    public function getUserWithFollowing($id) {
        return User::where('id', $id)->with(['educations','skills','followings'])->first();
    }

    public function getUserWithFollowers($id) {
        return User::where('id', $id)->with(['followers'])->first();
    }

    public function getUser($id) {
        return User::where('id', $id)->first();
    }

    public function getProfile($id) {
        return User::where('id', $id)->with(['experiences', 'skills', 'educations'])->first();
    }

    public function updateProfileSummary($summary, $user) {
        $user->profile_summary = $summary;
        $user->save();
    }

    public function addExperience($data, $experience = null) {
        if (is_null($experience)) {
            Experience::create($data);
        } else {
            $experience->update($data);
        }
    }

    public function getExpereinceById($id) {
        return Experience::where('id', $id)->first();
    }

    public function getSkillById($id) {
        return Skill::where('id', $id)->first();
    }

    public function createOrUpdateProfileSkill($data, $skill = null) {
        if (is_null($skill)) {
            Skill::create($data);
        } else {
            $skill->update($data);
        }
    }

    public function deleteSkill($id) {
        return Skill::where('id', $id)->delete();
    }

    public function getUniversityById($id) {
        return Education::where('id', $id)->first();
    }

    public function createOrUpdateProfileUniversity($data, $education = null) {
        if (is_null($education)) {
            Education::create($data);
        } else {
            $education->update($data);
        }
    }

    public function educationDelete($id) {
        return Education::where('id', $id)->delete();
    }

    public function createOrUpdateUser($data, $user = null) {
        if (is_null($user)) {
            User::create($data);
        } else {
            $user->update($data);
        }
    }

    public function userExists($id) {
        return ( count(User::find($id)) );
    }

    public function getUserWithVisitorChat($userId, $guestId) {
        /* return User::where('id',$userId )->with(['chats' => function ($query) use ( $guestId ) {
          $query->where('receiver_id', $guestId );
          }])->first(); */
        $where = array('sender_id' => $userId, 'receiver_id' => $guestId);
        $orWhere = array('receiver_id' => $userId, 'sender_id' => $guestId);
        return Chat::where($where)->orwhere($orWhere)->orderby("created_at")->get();
    }

    public function messagesRead($ids, $receiverId) {
        Chat::whereIn('id', $ids)
                ->where('receiver_id', $receiverId)
                ->where('is_read', 0)
                ->update(['is_read' => 1]);
    }

    public function isEmailExists($email) {
        return count(User::where('email', $email)->first());
    }

    public function getLastFiveMessage() {
        
    }

}
