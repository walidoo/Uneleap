<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Request as Temp;

class NotificationController extends Controller {

    public function getNotifications() {
        return ( new \App\Http\Gateways\NotificationGateway())->getNotifications();
    }

    public function updateHeader() {

        $data = ( new \App\Http\Gateways\ChatGateway())->getLastMessageOfEachConversation();
        $notificationData = ( new \App\Http\Gateways\NotificationGateway())->getNotificationForHeader();
        $view1 = view('pages.chat.messageUpdate')->with([
                    'messages' => $data
                ])->render();
        $view2 = view('pages.notifications.notificationHeaderUpdate')->with([
                    'notifications' => $notificationData['notifications']
                ])->render();
        return array(
            'status' => 1,
            'messageView' => $view1,
            'messageCount' => count($data),
            'unReadNotificationsCount' => $notificationData['unReadNotificationCount'],
            'notificationView' => $view2
        );
    }

}
