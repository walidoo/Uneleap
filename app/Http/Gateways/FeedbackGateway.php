<?php

namespace App\Http\Gateways;

use App\Repositories\QuestionRepository;
use App\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class FeedbackGateway {

    public function feedBack($request) {
        $user = \Auth::user();
        $filters = ['description', 'suggestion', 'rating'];
        $filteredData = CommonFunction::filterDataFromRequest($request->all(), $filters);
        $filteredData['user_id'] = $user->id;
        if ($request->hasFile('attachment')) {
            if ($request->file('attachment')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('attachment'), $user, 50, 50);
                $filteredData['attachment'] = $fileData['path'];
                $filteredData['filename'] = $fileData['filename'];
                \Log::debug(print_r($filteredData, true));
            }
        }
        ( new \App\Repositories\FeedbackRepository())->feedBack($filteredData);
        return redirect('/home');
    }

}
