<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Request as Temp;

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
