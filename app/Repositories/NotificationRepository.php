<?php

namespace App\Repositories;

use App\User;
use App\Experience;
use App\Skill;
use App\Education;
use App\Chat;
use App\Feedback;
use App\Notice;
use App\Notification;

class NotificationRepository {

    public function create($data) {
        Notification::create($data);
    }

    public function insert($data) {
        Notification::insert($data);
    }

    public function getNotificationForHeader($id) {
        return Notification::where('user_id', $id)
                        ->where('is_read', 0)
                        ->orderBy('created_at', 'Desc')->take(10)->get();
    }

    public function getUnReadNotificationsCount($id) {
        return Notification::where('user_id', $id)
                        ->where('is_read', 0)->count();
    }

    public function getNotifications($id) {
        return Notification::where('user_id', $id)
                        ->orderBy('created_at', 'Desc')
                        ->paginate(10);
    }

}
