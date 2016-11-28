<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Request as Temp;

class NoticeController extends Controller {

    public function noticeBoard() {
        return ( new \App\Http\Gateways\NoticeGateway())->getNoticeBoard();
    }

    public function generateNotice(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'file' => 'required|max:10048',
        ]);

        $mimeType = $request->file('file')->getMimeType();
        if (\App\Helpers\CommonFunction::isSupportedMimesType($mimeType)) {
            return ( new \App\Http\Gateways\NoticeGateway())->generateNotice($request);
        }
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.user.noticeForm')->with([
                    'user' => $user,
                    'image_error' => "File Type Not Supported"
        ]);
    }

    public function showNoticeForm(Request $request) {
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.user.noticeForm')->with([
                    'user' => $user,
        ]);
    }

    public function delete(Request $request) {
        if (!Temp::ajax() || !Temp::has('data')) {
            
        } else {
            $id = Temp::input('data')['id'];
            return ( new \App\Http\Gateways\UserGateway())->deleteNotice(\decrypt($id));
        }
    }
}
