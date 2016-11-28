<?php

namespace App\Http\Gateways;

use App\Repositories\QuestionRepository;
use App\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ChatGateway {

    public function openChatBox($id) {
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        $guest = (new \App\Http\Gateways\UserGateway())->getUser($id);
        $chats = (new \App\Repositories\ChatRepository())->getUserWithVisitorChat($user, $guest);
        foreach ($chats as &$chat) {
            if ($chat->sender_id == $user->id) {
                $chat['cssPull'] = 'pull-left';
                $chat['cssTimePull'] = 'pull-right';
                $chat['cssRight'] = '';
                $chat['name'] = $user->name;
                $chat['profile_picture_path'] = $user->profile_picture_path;

                $chat['profile_link'] = "/user/profile/".$user->id;
            } else {
                $chat['cssPull'] = 'pull-right';
                $chat['cssTimePull'] = 'pull-left';
                $chat['cssRight'] = 'right';
                $chat['name'] = $guest->name;
                $chat['profile_picture_path'] = $guest->profile_picture_path;

                $chat['profile_link'] = "/user/profile/".$guest->id;
            }
        }
        return view('pages.chat.window')->with([
                    'user' => $user,
                    'guest' => $guest,
                    'chats' => $chats,
        ]);
    }

    public function sendMessage($request) {
        $user = \Auth::user();
        $filters = ['message', 'receiver_id'];
        $filteredData = CommonFunction::filterDataFromRequest($request, $filters);
        $filteredData['sender_id'] = $user->id;
        if ((new \App\Repositories\UserRepository())->userExists($filteredData['receiver_id'])) {
            ( new \App\Repositories\ChatRepository())->sendMessage($filteredData);
        }
        return redirect('/user/chat/' . $filteredData['receiver_id']);
    }

    public function getLastMessageOfEachConversation() {
        $user = \Auth::user();
        $messages = (new \App\Repositories\ChatRepository())->getLastMessageOfEachConversation($user->id);
        $arrays = [];
        foreach ($messages as $object) {
            $arrays[] = (array) $object;
        }

        $users = [];
        $ids = array_pluck($messages, 'sender_id');
        $usersData = \App\User::whereIn('id', $ids)->get();
        foreach ($usersData as $user) {
            $users[$user->id] = $user;
        }
        foreach ($arrays as &$message) {
            if (!empty($users[$message['sender_id']])) {
                $message['sender_name'] = $users[$message['sender_id']]->name;
                if (empty($users[$message['sender_id']]->profile_picture_path)) {
                    $message['sender_pic'] = '/images/profile.png';
                } else {
                    $message['sender_pic'] = $users[$message['sender_id']]->profile_picture_path;
                }
                $carbonated_date = \Carbon\Carbon::parse($message['created_at']);
                $message['created_at'] = $carbonated_date->diffForHumans();
            }
        }
        return $arrays;
    }

    public function getMessages() {
        $user = \Auth::user();
        $messages = ( new \App\Repositories\ChatRepository())->getMessages($user->id);

        $arrays = [];
        foreach ($messages as $object) {
            $arrays[] = (array) $object;
        }
        $users = [];
        $ids = array_pluck($messages, 'sender_id');
        $usersData = \App\User::whereIn('id', $ids)->get();
        foreach ($usersData as $singleUser) {
            $users[$singleUser->id] = $singleUser;
        }
        foreach ($arrays as &$message) {
            if (!empty($users[$message['sender_id']])) {
                $message['sender_name'] = $users[$message['sender_id']]->name;
                $carbonated_date = \Carbon\Carbon::parse($message['created_at']);
                $message['created_at'] = $carbonated_date->diffForHumans();
            }
        }
        return view('pages.chat.mailbox')->with([
                    'user' => $user,
                    'inbox' => $arrays
        ]);
    }

    public function getSentMessages() {
        $user = \Auth::user();
        $messages = ( new \App\Repositories\ChatRepository())->getSentMessages($user->id);

        $arrays = [];
        foreach ($messages as $object) {
            $arrays[] = (array) $object;
        }
        $users = [];
        $ids = array_pluck($messages, 'receiver_id');
        $usersData = \App\User::whereIn('id', $ids)->get();
        foreach ($usersData as $user) {
            $users[$user->id] = $user;
        }
        foreach ($arrays as &$message) {
            if (!empty($users[$message['receiver_id']])) {
                $message['receiver_name'] = $users[$message['receiver_id']]->name;
                $carbonated_date = \Carbon\Carbon::parse($message['created_at']);
                $message['created_at'] = $carbonated_date->diffForHumans();
            }
        }
        return array('status' => 1, 'data' => view('pages.chat.sent')->with([
                'sent' => $arrays
            ])->render());
    }

    public function delete($id) {
        \App\Chat::where('id', $id)->delete();
        return array('status' => 1, 'id' => $id);
    }

}
