<?php

namespace App\Http\Gateways;

use App\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class UniversityGateway {

    public function universityNewsStore($request) {
        $user = Auth::user();
        $filters = ['title', 'description'];
        $data = CommonFunction::filterDataFromRequest($request->all(), $filters);
        $data['user_id'] = $user->id;
        $data['university_id'] = \decrypt($request->universityId);
        if ($request->hasFile('attachment')) {
            if ($request->file('attachment')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('attachment'), $user, 1000, 1000);
                $data['attachment'] = $fileData['path'];
                $data['filename'] = $fileData['filename'];
            }
        }
        \App\UniversityNews::create($data);
        return redirect('/admin/university/newsForm'); 
    }

    public function universityInfoStore($request) {
        $user = Auth::user();
        $filters = ['website', 'tag_line', 'name', 'email', 'phone', 'address', 'description1', 'description2', 'description3'];
        $data = CommonFunction::filterDataFromRequest($request->all(), $filters);
        $data['user_id'] = $user->id;
        $data['university_id'] = \decrypt($request->universityId);

        if ($request->hasFile('cover')) {
            if ($request->file('cover')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('cover'), $user, 1000, 1000);
                $data['cover'] = $fileData['path'];
                $data['cover_filename'] = $fileData['filename'];
            }
        }
        if ($request->hasFile('profile')) {
            if ($request->file('profile')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('profile'), $user, 1000, 1000);
                $data['profile'] = $fileData['path'];
                $data['profile_filename'] = $fileData['filename'];
            }
        }

        $university = \App\UniversityInfo::where('university_id', $data['university_id'])->first();
        if (empty($university)) {
            \App\UniversityInfo::create($data);
        } else {
            $university->update($data);
        }
        return redirect('/admin/university/basicInfo');
    }

}
