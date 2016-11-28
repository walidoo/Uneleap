<?php

namespace App\Repositories;

use App\Question;
use App\QuestionComment;
use App\QuestionLike;
use App\Dashboard;

class QuestionRepository {

    public function update($questionId, $data) {
        return Question::where('id', $questionId)->update($data);
    }

    public function create($data) {

        $question = Question::create($data);
        Dashboard::create([
            'dashboardable_id' => $question->id,
            'dashboardable_type' => 'App\Question',
            'user_id' => $data['user_id'],
        ]);
        return $question;
    }

    public function createQuestionFilters($data) {
        return \DB::table('question_filters')->insert($data);
    }

    public function getQuestions() {
        return Question::with(['tags', 'filters', 'likedByMe', 'user', 'likes', 'comments' => function ($query) {
                                $query->with('user');
                            }])
                        ->orderBy('created_at', 'Desc')->paginate(20);
    }

    public function getQuestionWithCommenntsLikes($id) {
        return Question::where('id', $id)->with(['tags', 'likedByMe', 'user', 'likes', 'comments' => function ($query) {
                        $query->with('user');
                    }])->first();
    }

    public function createComment($data) {
        return QuestionComment::create($data);
    }

    public function storeLike($data) {
        return QuestionLike::create($data);
    }

    public function isAlreadyLikedQuestion($user_id, $question_id) {
        $liked = QuestionLike::where('user_id', $user_id)->where('question_id', $question_id)->get();
        return (count($liked) > 0) ? true : false;
    }

}
