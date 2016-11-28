    <div class="row">
        <div class="col-md-9">
            <table class="table table-bordered" id="users-table">
                <thead>
                    <tr>
                        <th>profile</th>
                        <th>Name</th>
                        <th>Email</th>
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
                ajax: '/search/user',
                columns: [
                    {data: 'profile', name: 'profile', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'}
                ]
            });
        });
    </script>