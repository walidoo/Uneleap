<?php

namespace App\Repositories;

use App\User;
use App\Experience;
use App\Skill;
use App\Education;
use App\Chat;
use App\Feedback;
use App\Notice;

class ChatRepository {

    public function getUserWithVisitorChat($user, $guest) {
        $chats = ( new \App\Repositories\UserRepository())->getUserWithVisitorChat($user->id, $guest->id);
        $chatIds = array_pluck($chats, 'id');
        ( new \App\Repositories\UserRepository())->messagesRead($chatIds, $user->id);
        return $chats;
    }

    public function sendMessage($data) {
        return Chat::create($data);
    }

    public function getLastMessageOfEachConversation($id) {

        return \DB::select("select *
                            from chats msg
                            inner join
                            (
                              select max(created_at) created_at
                              from chats
                              where receiver_id=" . $id . "
                              && is_read=0
                              group by sender_id
                            ) m2
                              on msg.created_at = m2.created_at
                              where msg.receiver_id=" . $id . "
                               && msg.is_read=0
                              order by msg.created_at Desc
                              "
        );
    }

    public function getMessages($id) {
        return \DB::select("select *
                            from chats msg
                            inner join
                            (
                              select max(created_at) created_at
                              from chats
                              where receiver_id=" . $id . "
                              group by sender_id
                            ) m2
                              on msg.created_at = m2.created_at
                              where msg.receiver_id=" . $id . "
                              order by msg.created_at Desc
                              "
        );
    }

    public function getSentMessages( $id ) {
        return \DB::select("select *
                            from chats msg
                            inner join
                            (
                              select max(created_at) created_at
                              from chats
                              where sender_id=" . $id . "
                              group by receiver_id
                            ) m2
                              on msg.created_at = m2.created_at
                              where msg.sender_id=" . $id . "
                              order by msg.created_at Desc
                              "
        );
    }
}
