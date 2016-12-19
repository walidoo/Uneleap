<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Request as Temp;
use App\chat;
use Auth;

class ChatController extends Controller
{
    public function openChatBox( $id )
    {
        return (new \App\Http\Gateways\ChatGateway())->openChatBox( $id );
    }
    public function sendMessage( Request $request )
    {
        return ( new \App\Http\Gateways\ChatGateway() )->sendMessage($request->all());
    }

    //WR
    public function send_this_msg(Request $request) {
        $user = Auth::user();
        $data['sender_id'] = $user->id;
        $data['receiver_id'] = $request->input('receiver_id');
        $data['message'] = $request->input('message');
        $new_msg = Chat::create($data);
        /*$chat['cssPull'] = 'pull-left';
        $chat['cssTimePull'] = 'pull-right';
        $chat['cssRight'] = '';
        $chat['name'] = $user->name;
        $chat['profile_picture_path'] = $user->profile_picture_path;
        $chat['profile_link'] = "/user/profile/".$user->id;*/
        if($request->ajax()){
           return response()->json(['question_search' =>  $new_msg], 200);
        }
    }

    public function getMessages()
    {
        return ( new \App\Http\Gateways\ChatGateway())->getMessages();
    }
    public function getSentMessages()
    {
        return ( new \App\Http\Gateways\ChatGateway())->getSentMessages();
    }
    public function delete( Request $request)
    {
        if (!Temp::ajax() || !Temp::has('data')) {
            
        } else {
            $id = Temp::input('data')['id'];
            return ( new \App\Http\Gateways\ChatGateway())->delete($id);
        }
    }
}
