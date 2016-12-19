@extends('layouts.master')
@section('content')

<section class="content">

    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile">

                    <img src="{{ URL::asset('public/'.$user->profile_picture_path) }}" class="profileImg profile-user-img img-responsive img-circle" alt="User Image">

                    <script>



                    </script>
                    <h3 class="profile-username text-center">{{ $user->user_name  }}</h3>

                    <p class="text-muted text-center"></p>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About Me</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <strong><i class="fa fa-book margin-r-5"></i>Status</strong>

                    <p class="text-muted">
                        @if($user->user_type== Illuminate\Support\Facades\Config::get('constants.User_Type_Student'))

                        {{ $user->type }}

                        @elseif($user->user_type== Illuminate\Support\Facades\Config::get('constants.User_Type_Faculty'))
                        Faculty
                        @elseif($user->user_type== Illuminate\Support\Facades\Config::get('constants.User_Type_Guest'))
                        Guest
                        @elseif($user->user_type== Illuminate\Support\Facades\Config::get('constants.User_Type_Admin'))
                        Admin
                        @elseif($user->user_type== Illuminate\Support\Facades\Config::get('constants.User_Type_University'))
                        University
                        @endif
                    </p>

                    <hr>	
                    <strong><i class="fa fa-book margin-r-5"></i> University</strong>


                    <p class="text-muted">
                        <a href="/user/university/page/{{\encrypt($user->university_list_id)}}"> {{ $user->university }} </a>
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>


                    <p class="text-muted"> {{$user->country}} </p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>
                    <br>
                    @if(count($user['skills'])>0 )    
                    @foreach( $user['skills'] as $skill)
                    <span class="label label-success"> {{ $skill->name }}</span>
                    @endforeach
                    @else
                    Not Added
                    @endif

                    <hr>


                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
            <div class="nav-tabs-custom">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs pull-right">
                        <li class="libraryTab"><a href="#tab_2-2" data-toggle="tab" aria-expanded="false">Library</a></li>
                        <li class="questionTab active"><a href="#tab_3-2" data-toggle="tab" aria-expanded="true">Q&A</a></li>
                        <li class="pull-left header"><i class="fa fa-th"></i> TimeLine</li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="tab_1-1">
                            Tab 3
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2-2">
                            <div class="tab_2_Content">

                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="questionTab tab-pane active" id="tab_3-2">
                            @if(count($dashboard)>0)
                            @foreach( $dashboard as $data)
                            @if(!empty($data['item']))
                            @include('dashboardItems')
                            @endif
                            @endforeach
                            {{ $dashboard->links() }}
                            @else
                            No Data Found
                            @endif
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->

</section>

<script>

    $(document).ready(function () {
        var list = document.getElementsByClassName("myImage");
        for (var i = 0; i < list.length; i++) {
            var viewer = new Viewer(list[i], true);
        }
    });
</script>
<script>

    $(".libraryTab").click(function () {
        data = {};
        var params = new Object();
        params.data = data;
        var callback_urgencyAdminJdReport = $.Callbacks();
        callback_urgencyAdminJdReport.add(function takeAction(response)
        {


            $(".questionTab").removeClass("active");
            $("#tab_2-1").removeClass("active");

            $(".libraryTab").addClass("active");
            $("#tab_2-2").addClass("active");


            $(".tab_2_Content").html(response['data']);

            var list = document.getElementsByClassName("myImage");
            for (var i = 0; i < list.length; i++) {
                var viewer = new Viewer(list[i], true);
            }

        });
        var response = AjaxModule.postRequestReturnResponse('/user/getLibrariesForHomePage', 'POST', params, callback_urgencyAdminJdReport);
        return false;
    });
    $(document).ready(function () {
        $(document).on('click', '.libraryPaginator .pagination a', function (e)
        {
            getLibrariesPaginator($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
</script>
@endsection