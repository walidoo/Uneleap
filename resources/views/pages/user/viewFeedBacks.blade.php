@extends('layouts.master')
@section('content')

<section class="content" >
    <div id="searchResult">
        <div class="row">
            <div class="col-md-9">
                <table class="table table-bordered" id="users-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Suggestion</th>
                            <th>Description</th>
                            <th>Rating</th>
                            <th>Attachment</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!-- /.row -->
        <script>
            $(function () {
                $('#users-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/admin/getFeedbacks',
                    columns: [
                        {data: 'user.email', name: 'user.email'},
                        {data: 'suggestion', name: 'feedbacks.suggestion'},
                        {data: 'description', name: 'feedbacks.description'},
                        {data: 'rating', name: 'feedbacks.rating'},
                        {data: 'attachment', name: 'attachment', orderable: false, searchable: false},
                        {data: 'created_at', name: 'feedbacks.created_at'}
                    ]
                });
            });
        </script>
    </div>

</section>   
@endsection