@extends('layouts.master')
@section('content')

<section class="content" >
    <div class="form-group">
    <label>Select</label>
    <select class="form-control target">
      <option value="0">Users</option>
      <option value="1">Questions</option>
      <option value="2">Libraries</option>
    </select>
  </div>    
    <div id="searchResult">
         @include('pages.search.user')
    </div>

</section>   
<script>

$( ".target" ).change(function() {
    data = {'searchType':this.value};
    var params = new Object();
    params.data = data;
    var callback_urgencyAdminJdReport = $.Callbacks();
    callback_urgencyAdminJdReport.add(function takeAction(response)
    {
        if(response['status']==1)
        {
            $('#searchResult').html(response['data']);
            if(response['type']==1)
            {
                $('#question-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/search/question',
                    columns: [
                        {data: 'title', name: 'title'},
                        {data: 'description', name: 'description'},
                        {data: 'filters', name: 'filters.filter', orderable: false},

                    ]
                });
            }
            else if(response['type']==2)
            {
                $('#library-table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '/search/library',
                    columns: [
                        {data: 'profile', name: 'profile', orderable: false, searchable: false},
                        {data: 'title', name: 'title'},
                        {data: 'description', name: 'description'},
                        {data: 'author', name: 'author'},
                        {data: 'filters', name: 'filters.filter', orderable: false},

                    ]
                });
            }
            else if(response['type']==0)
            {
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
            }
        }
    });
    var response=AjaxModule.postRequestReturnResponse('/search/type','POST',params,callback_urgencyAdminJdReport);
    return false;
});

</script>
@endsection