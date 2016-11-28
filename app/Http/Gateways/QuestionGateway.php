<?php

namespace App\Http\Gateways;

use App\Repositories\QuestionRepository;
use App\Helpers\CommonFunction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use App\Http\Gateways\NotificationGateway;

class QuestionGateway {

    public function edit($request) {
        $user = Auth::user();
        $filters = ['title', 'file', 'description', 'privacy'];
        $id = \decrypt($request->questionId);
        $data = CommonFunction::filterDataFromRequest($request->all(), $filters);
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('file'), $user, 900, 300);
                $data['path'] = $fileData['path'];
                $data['filename'] = $fileData['filename'];
            }
        }
        $question = ( new QuestionRepository())->update($id, $data);
    }

    public function create($request) {
        \DB::beginTransaction();
        $user = Auth::user();
        $filters = ['title', 'file', 'description', 'privacy'];
        $data = CommonFunction::filterDataFromRequest($request->all(), $filters);
        $data['user_id'] = $user->id;
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $fileData = CommonFunction::uploadFile($request->file('file'), $user, 1000, 1000);
                $data['path'] = $fileData['path'];
                $data['filename'] = $fileData['filename'];
            }
        }
        $question = ( new QuestionRepository())->create($data);
        $this->insetQuestionFilters($request, $question, $user);
        $followers = $user->followers;
        if (!empty($followers)) {
            $follower_ids = array_pluck($followers, 'follower_id');
            ( new NotificationGateway)->toFollowersOnQuestionPost($user, $follower_ids, $question->id);
        }

        ( new NotificationGateway())->sameCategoryOnQuestionPost($request->all(), $user, $question->id);
        \DB::commit();
        return redirect('/questions/index');
    }

    public function insetQuestionFilters($request, $question, $user) {
        if (!empty($request->all()['tags'])) {
            $this->createFilter($request->all()['tags'], $user, $question, Config::get('constants.Filter_Type_Tag'));
        }
        if (!empty($request->all()['countries'])) {
            $this->createFilter($request->all()['countries'], $user, $question, Config::get('constants.Filter_Type_Country'));
        }
        if (!empty($request->all()['universities'])) {
            $uniName = array_pluck(\App\University::whereIn('id', $request->all()['universities'])->get(), 'name');
            $this->createFilter($uniName, $user, $question, Config::get('constants.Filter_Type_University'));
        }
        if (!empty($request->all()['courses'])) {
            $coursesName = array_pluck(\App\Course::whereIn('id', $request->all()['courses'])->get(), 'name');
            $this->createFilter($coursesName, $user, $question, Config::get('constants.Filter_Type_Course'));
        }
    }

    public function createFilter($filters, $user, $question, $type) {
        $tags = array();
        foreach ($filters as $filter) {
            array_push($tags, [ 'filter' => $filter,
                'type' => $type,
                'question_id' => $question->id,
                'user_id' => $user->id
            ]);
        }
        ( new QuestionRepository())->createQuestionFilters($tags);
    }

    public function getQuestions() {
        $user = \Auth::user();
        $questions = ( new QuestionRepository())->getQuestions();
        $questions = $this->setQuestionsToDisplay($questions, $user);
        $user = (new UserGateway())->getUser($user->id);
        return view('pages.questions.index')->with([
                    'questions' => $questions,
                    'user' => $user,
        ]);
    }

    public function setQuestionsToDisplay($questions, $user) {
        foreach ($questions as &$question) {
            if (!empty($question->path) && !empty($question->filename)) {
                if (CommonFunction::isImage($question->filename)) {
                    $question['attachment'] = '<img class="myImage img-responsive pad" src="' . $question->path . '" alt="Photo">';
                }
                if (CommonFunction::isAudtio($question->filename)) {
                    $question['attachment'] = '<audio controls>
                <source src="' . $question->path . '" type="audio/mpeg">
                Your browser does not support the audio tag.
              </audio>';
                }
                if (CommonFunction::isFile($question->filename)) {
                    $question['attachment'] = '<a  target="_blank" class="img-responsive pad" href="' . $question->path . '">' . $question->filename . '</a>';
                }
            }
            if (empty($question['user']->profile_picture_path)) {
                $user->profile_picture_path = '/images/profile.png';
            }
            if (count($question['likedByMe']) > 0) {
                $question['like'] = 1;
            }
            foreach ($question['comments'] as &$comment) {
                if (empty($comment['user']->profile_picture_path)) {
                    $comment['user']->profile_picture_path = '/images/profile.png';
                }
            }

            if ($question->privacy == 1 && $question->user_id != $user->id) {
                $question['isValidToDisplay'] = $this->isPrivateQuestionValidToDisplay($question, $user);
            } else {
                $question['isValidToDisplay'] = 1;
            }
        }
        return $questions;
    }

    public function isPrivateQuestionValidToDisplay($question, $user) {
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

    public function createCommentOnQuestion($request) {
        $user = Auth::user();
        $filters = ['comment', 'question_id'];
        $data = CommonFunction::filterDataFromRequest($request->all(), $filters);
        $question = \App\Question::findOrFail($data['question_id']);
        $data['user_id'] = $user->id;
        \DB::beginTransaction();
        ( new QuestionRepository())->createComment($data);
        if ($user->id != $question->user_id) {
            ( new NotificationGateway())->commentOnQuestion($user, $question->user_id, $data['question_id']);
        }
        \DB::commit();
        return redirect('/questions/index');
    }

    public function storeLike($request) {
        $user = Auth::user();
        $filters = ['question_id'];
        $data = CommonFunction::filterDataFromRequest($request->all(), $filters);
        $question = \App\Question::findOrFail($data['question_id']);
        $data['user_id'] = $user->id;
        if (!( new QuestionRepository())->isAlreadyLikedQuestion($data['user_id'], $data['question_id'])) {
            \DB::beginTransaction();
            ( new QuestionRepository())->storeLike($data);
            if ($user->id != $question->user_id) {
                ( new NotificationGateway())->likeOnQuestion($user, $question->user_id, $data['question_id']);
            }
            \DB::commit();
        }
        return redirect('/questions/index');
    }

    public function getQuestion($id) {
        $user = \Auth::user();
        $question = ( new QuestionRepository())->getQuestionWithCommenntsLikes(\decrypt($id));
        $question = $this->setQuestionToDisplay($question, $user);
        return view('pages.questions.singleQuestion')->with([
                    'question' => $question,
                    'user' => $user
        ]);
    }

    public function setQuestionToDisplay($question, $user) {
        if (!empty($question->path) && !empty($question->filename)) {
            if (CommonFunction::isImage($question->filename)) {
                $question['attachment'] = '<img class="img-responsive pad" src="' . $question->path . '" alt="Photo">';
            }
            if (CommonFunction::isAudtio($question->filename)) {
                $question['attachment'] = '<audio controls>
                <source src="' . $question->path . '" type="audio/mpeg">
                Your browser does not support the audio tag.
              </audio>';
            }
            if (CommonFunction::isFile($question->filename)) {
                $question['attachment'] = '<a  target="_blank" class="img-responsive pad" href="' . $question->path . '">' . $question->filename . '</a>';
            }
        }
        if (empty($question['user']->profile_picture_path)) {
            $user->profile_picture_path = '/images/profile.png';
        }
        if (count($question['likedByMe']) > 0) {
            $question['like'] = 1;
        }
        foreach ($question['comments'] as &$comment) {
            if (empty($comment['user']->profile_picture_path)) {
                $comment['user']->profile_picture_path = '/images/profile.png';
            }
        }

        if ($question->privacy == 1) {
            $question['isValidToDisplay'] = $this->isPrivateQuestionValidToDisplay($question, $user);
        } else {
            $question['isValidToDisplay'] = 1;
        }
        return $question;
    }

    public function delete($id) {
        \App\Question::where('id', $id)->delete();
        \App\Dashboard::where('dashboardable_id', $id)
                       ->where('dashboardable_type', 'App\Question')
                       ->delete();
        return array('status' => 1, 'id' => $id);
    }

    public function deleteComment($id) {
        \App\QuestionComment::where('id', $id)->delete();
        return array('status' => 1, 'id' => $id);
    }

    public function editComment($id, $comment) {
        \App\QuestionComment::where('id', $id)->update(['comment' => $comment]);
        return array('status' => 1, 'id' => $id);
    }

}
