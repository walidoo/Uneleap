<?php

namespace App\Http\Gateways;

use App\Repositories\LibraryRepository;
use App\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Http\Gateways\NotificationGateway;

class LibraryGateway {

    public function edit($request) {
        $user = Auth::user();
        $filters = ['title', 'description', 'author', 'privacy'];
        $data = CommonFunction::filterDataFromRequest($request->all(), $filters);
        $data['user_id'] = $user->id;
        if ($request->hasFile('cover')) {
            if ($request->file('cover')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('cover'), $user, 50, 50);
                $data['cover'] = $fileData['path'];
                $data['cover_extension'] = $fileData['extension'];
                $data['cover_filename'] = $fileData['filename'];
            }
        }
        if ($request->hasFile('attachment')) {
            if ($request->file('attachment')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('attachment'), $user);
                $data['attachment'] = $fileData['path'];
                $data['attachment_extension'] = $fileData['extension'];
                $data['attachment_filename'] = $fileData['filename'];
            }
        }
        ( new LibraryRepository())->update(\decrypt($request->libraryId), $data);
        return redirect("/library/get/" . $request->libraryId);
    }

    public function editComment($id, $comment) {
        \App\LibraryComment::where('id', $id)->update(['comment' => $comment]);
        return array('status' => 1, 'id' => $id);
    }

    public function deleteComment($id) {
        \App\LibraryComment::where('id', $id)->delete();
        return array('status' => 1, 'id' => $id);
    }

    public function delete($id) {
        \App\Library::where('id', $id)->delete();
        \App\Dashboard::where('dashboardable_id', $id)
                ->where('dashboardable_type', 'App\Library')
                ->delete();
        return array('status' => 1, 'id' => $id);
    }

    public function create($request) {
        \DB::beginTransaction();
        $user = Auth::user();
        $filters = ['title', 'description', 'author', 'privacy'];
        $data = CommonFunction::filterDataFromRequest($request->all(), $filters);
        $data['user_id'] = $user->id;
        if ($request->hasFile('cover')) {
            if ($request->file('cover')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('cover'), $user, 50, 50);
                $data['cover'] = $fileData['path'];
                $data['cover_extension'] = $fileData['extension'];
                $data['cover_filename'] = $fileData['filename'];
            }
        }
        if ($request->hasFile('attachment')) {
            if ($request->file('attachment')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('attachment'), $user, 1000, 100);
                $data['attachment'] = $fileData['path'];
                $data['attachment_extension'] = $fileData['extension'];
                $data['attachment_filename'] = $fileData['filename'];
            }
        }
        $library = ( new LibraryRepository())->create($data);
        $this->insetLibraryFilters($request->all(), $library, $user);
        $followers = $user->followers;
        if (!empty($followers)) {
            $follower_ids = array_pluck($followers, 'follower_id');
            ( new NotificationGateway)->toFollowersOnLibraryPost($user, $follower_ids, $library->id);
        }

        ( new NotificationGateway())->sameCategoryOnLibraryPost($request->all(), $user, $library->id);
        \DB::commit();
        return redirect('/libraries/index');
    }

    public function insetLibraryFilters($data, $library, $user) {
        if (!empty($data['tags'])) {
            $this->createFilter($data['tags'], $user, $library, Config::get('constants.Filter_Type_Tag'));
        }
        if (!empty($data['languages'])) {
            $this->createFilter($data['languages'], $user, $library, Config::get('constants.Filter_Type_Language'));
        }
        if (!empty($data['countries'])) {
            $this->createFilter($data['countries'], $user, $library, Config::get('constants.Filter_Type_Country'));
        }
        if (!empty($data['universities'])) {
            $uniName = array_pluck(\App\University::whereIn('id', $data['universities'])->get(), 'name');
            $this->createFilter($uniName, $user, $library, Config::get('constants.Filter_Type_University'));
        }
        if (!empty($data['courses'])) {
            $coursesName = array_pluck(\App\Course::whereIn('id', $data['courses'])->get(), 'name');
            $this->createFilter($coursesName, $user, $library, Config::get('constants.Filter_Type_Course'));
        }
    }

    public function createFilter($filters, $user, $library, $type) {
        $tags = array();
        foreach ($filters as $filter) {
            array_push($tags, [ 'filter' => $filter,
                'type' => $type,
                'library_id' => $library->id,
                'user_id' => $user->id
            ]);
        }
        ( new LibraryRepository())->createQuestionFilters($tags);
    }

    public function getLibraries() {
        $libraries = ( new LibraryRepository())->getLibraries();
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        foreach ($libraries as &$question) {
            if ($question->privacy == 1 && $question->user_id != $user->id) {
                $question['isValidToDisplay'] = $this->isValidToReturnRowIfLibraryIsPrivate($question, $user);
            } else {
                $question['isValidToDisplay'] = 1;
            }

            if (!empty($question->attachment) && !empty($question->attachment_filename)) {
                if (CommonFunction::isImage($question->attachment_filename)) {
                    $question['attachment'] = '<img class="myImage img-responsive pad" src="' . $question->attachment . '" alt="Photo">';
                }
                if (CommonFunction::isAudtio($question->attachment_filename)) {
                    $question['attachment'] = '<audio controls>
                <source src="' . $question->attachment . '" type="audio/mpeg">
                Your browser does not support the audio tag.
              </audio>';
                }
                if (CommonFunction::isFile($question->attachment_filename)) {
                    $question['attachment'] = '<a  target="_blank" class="img-responsive pad" href="' . $question->attachment . '">' . $question->attachment_filename . '</a>';
                }
            }
        }
        return view('pages.libraries.index')->with([
                    'libraries' => $libraries,
                    'user' => $user,
        ]);
    }

    public function isValidToReturnRowIfLibraryIsPrivate($question, $user) {
        $collection = $question['filters'];
        if (!empty($user->university)) {
            $filtered = $collection->where('type', 2);
            if (in_array($user->university, array_pluck($filtered, 'filter'))) {
                return 1;
            }
        }
        if (!empty($user->country)) {
            $filtered = $collection->where('type', 1);
            if (in_array($user->country, array_pluck($filtered, 'filter'))) {
                return 1;
            }
        }
        if (!empty($user->degree)) {
            $filtered = $collection->where('type', 3);
            if (in_array($user->degree, array_pluck($filtered, 'filter'))) {
                return 1;
            }
        }
        return 0;
    }

    public function getLibrary($id) {
        $user = \Auth::user();
        $library = ( new LibraryRepository())->getLibrary($id);
        //awais
        $library = $this->setAttachmentForSingleLibrary( $library );
        return view('pages.libraries.singleLibrary')->with([
                    'library' => $library,
                    'user' => $user
        ]);
    }

    public function setAttachmentForSingleLibrary( $question ) {
        if (!empty($question->attachment) && !empty($question->attachment_filename)) {
            if (CommonFunction::isImage($question->attachment_filename)) {
                $question['attachment'] = '<img class="myImage img-responsive pad" src="' . $question->attachment . '" alt="Photo">';
            }
            if (CommonFunction::isAudtio($question->attachment_filename)) {
                $question['attachment'] = '<audio controls>
                <source src="' . $question->attachment . '" type="audio/mpeg">
                Your browser does not support the audio tag.
              </audio>';
            }
            if (CommonFunction::isFile($question->attachment_filename)) {
                $question['attachment'] = '<a  target="_blank" class="img-responsive pad" href="' . $question->attachment . '">' . $question->attachment_filename . '</a>';
            }
        }
        return $question;
    }

    public function createCommentOnLibrary($request) {
        $user = Auth::user();
        $filters = ['comment', 'library_id'];
        $data = CommonFunction::filterDataFromRequest($request->all(), $filters);
        $library = \App\Library::findOrFail($data['library_id']);
        $data['user_id'] = $user->id;
        \DB::beginTransaction();
        ( new LibraryRepository())->createComment($data);
        if ($user->id != $library->user_id) {
            ( new NotificationGateway())->commentOnLibrary($user, $library->user_id, $data['library_id']);
        }
        \DB::commit();
        return redirect('/libraries/index');
    }

}
