    <div class="row" id="q_result">
        @if( sizeof($user_search) != 0 )
        @foreach( $user_search as $each_user )
          <div class="col-md-4 col-sm-6 col-xs-12" id="search_result">
                  <div class="info-box">
                    <span class="info-box-icon bg-green">
                        @if( !empty($each_user->profile_picture_path) )
                          <img src="{{ URL::asset('public/'.$each_user->profile_picture_path) }}" class="user-image" alt="User Image">
                          @else
                          <img src="{{ URL::asset('public/images/profile.png') }}" class="user-image" alt="User Image">
                        @endif
                    </span>
                    <div class="info-box-content">
                      <span class="info-box-number"><a href="{{ url('/user/profile/'.$each_user->id) }}">{{ $each_user->user_name }}</a></span>
                    </div>
                    <!-- /.info-box-content -->
                  </div>
                  <!-- /.info-box -->
          </div>
        @endforeach
        @else
        <div class="col-md-6">
            <h4>There are no users matched with the search key!</h4>
        </div>
        @endif
    </div>
    <!-- /.row -->
    <script>
        /*$(function () {
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
        });*/
    </script>