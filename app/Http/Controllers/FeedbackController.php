<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class FeedbackController extends Controller {

    public function feedbackForm() {
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.user.feedback')->with([
                    'user' => $user,
        ]);
    }

    public function feedback(Request $request) {
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        $this->validate($request, [
            'description' => 'required',
            'suggestion' => 'required',
            'rating' => 'required',
            'attachment' => 'sometimes',
        ]);
        if ($request->hasFile('attachment')) {
            $mimeType = $request->file('attachment')->getMimeType();
            if (\App\Helpers\CommonFunction::isSupportedMimesTypeImageOrDoc($mimeType)) {
                 return (new \App\Http\Gateways\FeedbackGateway())->feedBack($request);
            } else {
                return view('pages.user.feedback')->with([
                            'user' => $user,
                            'image_error' => "File Type Not Supported"
                ]);
            }
        }
          return (new \App\Http\Gateways\FeedbackGateway())->feedBack($request);
    }
    public function viewFeedback()
    {
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.user.viewFeedBacks')->with([
                            'user' => $user
                ]);
    }

}
