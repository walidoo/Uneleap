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
                            <th>University</th>
                            <th>Country</th>
                            <th>Action</th>
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
                    "drawCallback": function (settings) {
                        $(".userStatus").change(function () {
                            data = this.value;
                            var params = new Object();
                            params.data = data;
                            var callback_urgencyAdminJdReport = $.Callbacks();
                            callback_urgencyAdminJdReport.add(function takeAction(response)
                            {
                                //location.reload();
                            });
                            var response = AjaxModule.postRequestReturnResponse('/user/updateUserStatus', 'POST', params, callback_urgencyAdminJdReport);
                            return false;
                        });
                    },
                    processing: true,
                    serverSide: true,
                    ajax: '/admin/getUserManagement',
                    columns: [
                        {data: 'email', name: 'email'},
                        {data: 'country', name: 'country'},
                        {data: 'university', name: 'university'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                        {data: 'created_at', name: 'created_at'}
                    ]
                });
            });
        </script>
    </div>

</section>   
@endsection