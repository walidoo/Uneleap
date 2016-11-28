<?php

namespace App\Repositories;

use App\Library;
use App\LibraryComment;
use App\Dashboard;
class LibraryRepository {

    public function update($libraryId, $data) {
        return Library::where('id', $libraryId)->update($data);
    }

    public function create($data) {
        
        $library =  Library::create($data);
        Dashboard::create([
            'dashboardable_id' => $library->id,
            'dashboardable_type' => 'App\Library',
            'user_id' => $data['user_id'],
        ]);
        return $library;
    }

    public function createQuestionFilters($data) {
        return \DB::table('library_filters')->insert($data);
    }

    public function getLibraries() {
        return Library::with(['tags','filters', 'user', 'comments' => function ($query) {
                                $query->with('user');
                            }])
                        ->orderBy('created_at', 'Desc')->paginate(20);
    }

    public function createComment($data) {
        return LibraryComment::create($data);
    }

    public function getLibrary($id) {
        return \App\Library::where('id', $id)->with(['tags','filters', 'user', 'comments' => function ($query) {
                        $query->with('user');
                    }])->first();
    }

}
