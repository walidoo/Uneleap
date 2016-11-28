<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Request as Temp;
use App\Http\Requests;

class LibraryController extends Controller {

    public function delete(Request $request) {
        if (!Temp::ajax() || !Temp::has('data')) {
            
        } else {
            $id = Temp::input('data')['id'];
            $questionId = \decrypt($id);
            return ( new \App\Http\Gateways\LibraryGateway())->delete($questionId);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return ( new \App\Http\Gateways\LibraryGateway)->getLibraries();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.libraries.create')->with([
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
            'languages' => 'required',
            'tags' => 'required',
       //     'countries' => 'required_if:privacy,1',
       //     'courses' => 'required_if:privacy,1',
       //     'universities' => 'required_if:privacy,1',
            'author' => 'required',
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'attachment' => 'required|max:10048',
            'description' => 'required',
            'privacy' => 'required',
        ]);

        $mimeType = $request->file('attachment')->getMimeType();
        if (\App\Helpers\CommonFunction::isSupportedMimesType($mimeType)) {
            return ( new \App\Http\Gateways\LibraryGateway())->create($request);
        }
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.libraries.create')->with([
                    'user' => $user,
                    'image_error' => "File Type Not Supported"
        ]);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
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

    public function getLibrary($id) {
        return ( new \App\Http\Gateways\LibraryGateway())->getLibrary(\decrypt($id));
    }

    public function getLibraryWithNotification($id, $notificationId) {
        \App\Notification::where('id', \decrypt($notificationId))
                ->update(['is_read' => 1]);
        return $this->getLibrary($id);
    }

    public function storeComment(Request $request) {
        return ( new \App\Http\Gateways\LibraryGateway())->createCommentOnLibrary($request);
    }

    public function deleteComment(Request $request) {
        if (!Temp::ajax() || !Temp::has('data')) {
            
        } else {
            $id = Temp::input('data')['id'];
            return ( new \App\Http\Gateways\LibraryGateway())->deleteComment(\decrypt($id));
        }
    }

    public function commentStore() {
        if (!Temp::ajax() || !Temp::has('data')) {
            
        } else {
            $id = Temp::input('data')['id'];
            $comment = Temp::input('data')['comment'];
            return ( new \App\Http\Gateways\LibraryGateway())->editComment(\decrypt($id), $comment);
        }
    }

    public function editLibraryForm($id) {

        $user = \Auth::user();
        $library = \App\Library::where('id', \decrypt($id))->first();
        return view('pages.libraries.edit')->with(
                        [
                            'user' => $user,
                            'library' => $library
                        ]
        );
    }

    public function editLibraryStore(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'cover' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:10048',
            'attachment' => 'sometimes|max:10048',
            'description' => 'required',
            'privacy' => 'required',
            'libraryId' => 'required',
        ]);
        if ($request->hasFile('attachment')) {
            $mimeType = $request->file('attachment')->getMimeType();
            if (\App\Helpers\CommonFunction::isSupportedMimesType($mimeType)) {
                return ( new \App\Http\Gateways\LibraryGateway())->edit($request);
            }
        } else {
            return ( new \App\Http\Gateways\LibraryGateway())->edit($request);
        }
        $user = (new \App\Http\Gateways\UserGateway())->getUser(\Auth::id());
        return view('pages.libraries.create')->with([
                    'user' => $user,
                    'image_error' => "File Type Not Supported"
        ]);
    }

}
