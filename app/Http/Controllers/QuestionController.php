<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Gateways\QuestionGateway;
use App\Http\Requests;
use Request as Temp;

class QuestionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return ( new QuestionGateway())->getQuestions();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.questions.create')->with([
                    'user' => $user,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'tags' => 'required',
            'file' => 'sometimes|max:10048',
            'description' => 'required',
            'privacy' => 'required',
        ]);
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        if ($request->hasFile('file')) {
            if ($request->file('file')->isValid()) {
                $mimeType = $request->file('file')->getMimeType();
                if (\App\Helpers\CommonFunction::isSupportedMimesType($mimeType)) {
                    return ( new QuestionGateway())->create($request);
                } else {
                    return view('pages.questions.create')->with([
                                'user' => $user,
                                'image_error' => "File Type Not Supported"
                    ]);
                }
            }
        }
        return ( new QuestionGateway())->create($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function storeComment(Request $request) {
        return ( new QuestionGateway())->createCommentOnQuestion($request);
    }

    public function storeLike(Request $request) {
        return ( new QuestionGateway())->storeLike($request);
    }

    public function getQuestion($id) {
        // $questionId = \decrypt($id);
        return ( new QuestionGateway())->getQuestion($id);
    }
    public function getQuestionWithNotification($id,$notificationId)
    {
        $notification = \App\Notification::where('id',  \decrypt($notificationId))
                ->update(['is_read' => 1]);
        return $this->getQuestion($id);
    }

    public function delete(Request $request) {
        if (!Temp::ajax() || !Temp::has('data')) {
            
        } else {
            $id = Temp::input('data')['id'];
            $questionId = \decrypt($id);
            return ( new \App\Http\Gateways\QuestionGateway())->delete($questionId);
        }
    }

    public function deleteComment(Request $request) {
        if (!Temp::ajax() || !Temp::has('data')) {
            
        } else {
            $id = Temp::input('data')['id'];
            return ( new \App\Http\Gateways\QuestionGateway())->deleteComment(\decrypt($id));
        }
    }

    public function editComment(Request $request) {
        if (!Temp::ajax() || !Temp::has('data')) {
            
        } else {
            $id = Temp::input('data')['id'];
            $comment = Temp::input('data')['comment'];
            return ( new \App\Http\Gateways\QuestionGateway())->editComment(\decrypt($id), $comment);
        }
    }

    public function edit($id) {

        $user = \Auth::user();
        $question = \App\Question::where('id', \decrypt($id))->with([
                    'countries', 'tags', 'universities', 'courses'
                ])->first();
        return view('pages.questions.edit')->with(
                        [
                            'user' => $user,
                            'question' => $question
                        ]
        );
    }

    public function editStore(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'file' => 'sometimes|max:10048',
            'description' => 'required',
            'privacy' => 'required',
            'questionId' => 'required'
        ]);
        if ($request->hasFile('file')) {
            $mimeType = $request->file('file')->getMimeType();
            if (\App\Helpers\CommonFunction::isSupportedMimesType($mimeType)) {
                ( new QuestionGateway())->edit($request);
            }
            $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
            return view('pages.questions.create')->with([
                        'user' => $user,
                        'image_error' => "File Type Not Supported"
            ]);
        } else {
            ( new QuestionGateway())->edit($request);
        }
        return redirect('/question/get/' . $request->questionId);
    }

}
