<?php

namespace App\Http\Gateways;

use App\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Repositories\NotificationRepository;

class NotificationGateway {

    public function FollowingRequest($user, $guestId, $followId) {
        $data = [
            'title' => $user->name . " sent you a Following request",
            'description' => "",
            'type' => Config::get('constants.Notification_Type_Send_Following_Request'),
            'notificationable_id' => $followId,
            'notificationable_type' => "App\Follower",
            'user_id' => $guestId
        ];
        ( new NotificationRepository())->create($data);
    }

    public function acceptFollowingRequest($user, $guestId, $followId) {
        $data = [
            'title' => $user->name . " accepted your  Following request",
            'description' => "",
            'type' => Config::get('constants.Notification_Type_Accept_Following_Request'),
            'notificationable_id' => $followId,
            'notificationable_type' => "App\Follower",
            'user_id' => $guestId
        ];
        ( new NotificationRepository())->create($data);
    }

    public function commentOnQuestion($user, $questionUserId, $questionId) {
        $data = [
            'title' => $user->name . " commented on your question",
            'description' => "",
            'type' => Config::get('constants.Notification_Type_Comment_On_Question'),
            'notificationable_id' => $questionId,
            'notificationable_type' => "App\Question",
            'user_id' => $questionUserId
        ];
        ( new NotificationRepository())->create($data);
    }

    public function likeOnQuestion($user, $questionUserId, $questionId) {
        $data = [
            'title' => $user->name . " liked your question",
            'description' => "",
            'type' => Config::get('constants.Notification_Type_Like_On_Question'),
            'notificationable_id' => $questionId,
            'notificationable_type' => "App\Question",
            'user_id' => $questionUserId
        ];
        ( new NotificationRepository())->create($data);
    }

    public function getNotificationForHeader() {
        $user = \Auth::user();
        $notifications = ( new NotificationRepository)->getNotificationForHeader($user->id);
        $notifications = $this->setHrefForNotifications($notifications);
        $unReadNotificationCount = ( new NotificationRepository())->getUnReadNotificationsCount($user->id);
        return array('notifications' => $notifications, 'unReadNotificationCount' => $unReadNotificationCount);
    }

    public function getNotifications() {
        $user = \Auth::user();
        $notifications = ( new NotificationRepository())->getNotifications($user->id);
        $notifications = $this->setHrefForNotifications($notifications);
        return view('pages.notifications.index')->with([
                    'notifications' => $notifications,
                    'user' => $user
        ]);
    }

    public function setHrefForNotifications($notifications) {
        foreach ($notifications as &$notification) {
            if ($notification->type == Config::get('constants.Notification_Type_Send_Following_Request') || $notification->type == Config::get('constants.Notification_Type_Accept_Following_Request')) {
                $follower = $notification->notificationable;
                if (!empty($follower)) {
                    if ($notification->type == Config::get('constants.Notification_Type_Send_Following_Request')) {
                        $id = $follower->follower_id;
                    } else {
                        $id = $follower->following_id;
                    }
                    $notification['href'] = "/user/profile/" . $id . "/" . \encrypt($notification->id);
                }
            } else if (
                    $notification->type == Config::get('constants.Notification_Type_Like_On_Question') ||
                    $notification->type == Config::get('constants.Notification_Type_Comment_On_Question') ||
                    $notification->type == Config::get('constants.Notification_Type_Following_Posted_Question') ||
                    $notification->type == Config::get('constants.Notification_Type_Question_Post_In_Category')
            ) {
                $notification['href'] = "/question/get/" . \encrypt($notification->notificationable_id) . "/" . \encrypt($notification->id);
            } else if (
                    $notification->type == Config::get('constants.Notification_Type_Following_Posted_Library') ||
                    $notification->type == Config::get('constants.Notification_Type_Library_Post_In_Category')
            ) {
                $notification['href'] = "/library/get/" . \encrypt($notification->notificationable_id) . "/" . \encrypt($notification->id);
            } else if ($notification->type == Config::get('constants.Notification_Type_Comment_On_Library')) {
                $notification['href'] = "/library/get/" . \encrypt($notification->notificationable_id) . "/" . \encrypt($notification->id);
            } else if ($notification->type == Config::get('constants.Notification_Type_Event_Post_In_Category')) {
                $notification['href'] = "/events/" . $notification->notificationable_id;
            } else {
                error_log($notification->type);
                $notification['href'] = "";
            }
        }
        return $notifications;
    }

    public function toFollowersOnQuestionPost($user, $follower_ids, $questionId) {
        $data = [];
        foreach ($follower_ids as $id) {
            $data[] = [
                'title' => $user->name . " posted a Question",
                'description' => "",
                'type' => Config::get('constants.Notification_Type_Following_Posted_Question'),
                'notificationable_id' => $questionId,
                'notificationable_type' => "App\Question",
                'user_id' => $id,
                'created_at' => \date('Y-m-d H:i:s'),
                'updated_at' => \date('Y-m-d H:i:s'),
            ];
        }
        ( new NotificationRepository())->insert($data);
    }

    public function toFollowersOnEventPost($user, $follower_ids, $eventId) {
        $data = [];
        foreach ($follower_ids as $id) {
            $data[] = [
                'title' => $user->name . " created a Event",
                'description' => "",
                'type' => Config::get('constants.Notification_Type_Event_Post_In_Category'),
                'notificationable_id' => $eventId,
                'notificationable_type' => "App\Event",
                'user_id' => $id,
                'created_at' => \date('Y-m-d H:i:s'),
                'updated_at' => \date('Y-m-d H:i:s'),
            ];
        }
        ( new NotificationRepository())->insert($data);
    }

    public function toFollowersOnLibraryPost($user, $follower_ids, $libraryId) {
        $data = [];
        foreach ($follower_ids as $id) {
            $data[] = [
                'title' => $user->name . " posted in a Library",
                'description' => "",
                'type' => Config::get('constants.Notification_Type_Following_Posted_Library'),
                'notificationable_id' => $libraryId,
                'notificationable_type' => "App\Library",
                'user_id' => $id,
                'created_at' => \date('Y-m-d H:i:s'),
                'updated_at' => \date('Y-m-d H:i:s'),
            ];
        }
        ( new NotificationRepository())->insert($data);
    }

    public function commentOnLibrary($user, $libraryUserId, $qlibraryId) {
        $data = [
            'title' => $user->name . " commented on your library",
            'description' => "",
            'type' => Config::get('constants.Notification_Type_Comment_On_Library'),
            'notificationable_id' => $qlibraryId,
            'notificationable_type' => "App\Library",
            'user_id' => $libraryUserId
        ];
        ( new NotificationRepository())->create($data);
    }

    public function sameCategoryOnQuestionPost($data, $user, $questionId) {
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
                    'title' => $user->name . " posted a Question in your category",
                    'description' => "",
                    'type' => Config::get('constants.Notification_Type_Question_Post_In_Category'),
                    'notificationable_id' => $questionId,
                    'notificationable_type' => "App\Question",
                    'user_id' => $id,
                    'created_at' => \date('Y-m-d H:i:s'),
                    'updated_at' => \date('Y-m-d H:i:s'),
                ];
            }
            ( new NotificationRepository())->insert($notifications);
        }
    }

    public function sameCategoryOnLibraryPost($data, $user, $libraryId) {
        $id = $user->id;
        if (!empty($data['universities']) && !empty($data['courses']) && !empty($data['countries'])) {
            $userIdsUniversities = \DB::table('users')
                            ->where('id', '!=', $id)
                            ->whereIn('university_list_id', $data['universities'])
                            ->select('id')->get();
            $course_list_id = \DB::table('users')
                            ->where('id', '!=', $id)
                            ->whereIn('university_list_id', $data['courses'])
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
                    'title' => $user->name . " posted in a Library related to your category",
                    'description' => "",
                    'type' => Config::get('constants.Notification_Type_Question_Post_In_Category'),
                    'notificationable_id' => $libraryId,
                    'notificationable_type' => "App\Question",
                    'user_id' => $id,
                    'created_at' => \date('Y-m-d H:i:s'),
                    'updated_at' => \date('Y-m-d H:i:s'),
                ];
            }
            ( new NotificationRepository())->insert($notifications);
        }
    }

}
