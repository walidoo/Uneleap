@extends('layouts.master')
@section('content')

<div class="col-md-10">
    <div class="box box-widget widget-user">
        <!-- Add the bg color to the header using any of the bg-* classes -->
        <div class="widget-user-header bg-black" style="background: url('{{$guest->profile_cover_path}}') center center;">
            <h3 class="widget-user-username">{{$guest->name}}</h3>
            <h5 class="widget-user-desc"></h5>
        </div>
        <div class="widget-user-image">
            <img class="img-circle" src="{{$guest->profile_picture_path}}" alt="User Avatar">
        </div>
        <div class="box-footer">
            <div class="row">

                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        @if($user->id!=$guest->id)
                        <form id="followForm" class="form-horizontal" method="post" action="/user/follow">
                            {{ csrf_field() }} 
                            <input type="hidden" name="status" value='{{\encrypt($followStatus['code'])}}'>
                            <input type="hidden" id="dummy_status" name="dummy_status" value='{{$followStatus['code']}}'>
                            <input type="hidden" name="guest_user_id" value='{{\encrypt($guest->id)}}'>
                            <span style="color: #3c8dbc; cursor:pointer;" class="description-text">
                                <a onClick="follow()">
                                    {{$followStatus['message']}}
                                </a>
                            </span>
                        </form>
                        @endif
                        @if($followingRequest == 1)
                        <span  class="description-text">
                            Following Request !
                            <a style="cursor:pointer;" onClick="accetpOrRejectFollow('{{\encrypt($guest->id)}}','{{\encrypt(2)}}')">
                                Accept
                            </a>
                            /
                            <a style="cursor:pointer;" onClick="accetpOrRejectFollow('{{\encrypt($guest->id)}}','{{\encrypt(3)}}')">
                                Reject
                            </a>
                        </span>
                        @endif
                    </div>
                    <!-- /.description-block -->
                </div>

                <!-- /.col -->
                <div class="col-sm-4 border-right">
                    <div class="description-block">
                        <h5 class="description-header">{{count($guest['followers'])}}</h5>
                        <span class="description-text">FOLLOWERS</span>
                    </div>
                    <!-- /.description-block -->
                </div>
                <!-- /.col -->
                @if($user->id!=$guest->id && $isUserAllowedToChat == 1)
                <div class="col-sm-4">
                    <div class="description-block">
                        <h5 class="description-header"></h5>
                        <span class="description-text">
                            <a href="/user/chat/{{$guest->id}}">    Start Chat </a>
                        </span>
                    </div>
                    <!-- /.description-block -->
                </div>
                @endif
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">About Me</h3>
            </div>
            <!-- /.box-header -->
            
            <div class="box-body">
                
                @if($guest->privacy == 1 )
                    <strong><i class="fa fa-book margin-r-5"></i> Education</strong>
                    @if(count($guest['educations'])>0)
                        @foreach( $guest['educations'] as $education)
                        <p class="text-muted">
                            {{ $education->school_name }}
                        </p>
                        @endforeach
                    @else
                       <p class="text-muted">
                             Not Added
                        </p>
                    @endif
                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                    <p class="text-muted">{{ $guest->country}}</p>

                    <hr>

                    <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                    <p>
                    @if(count($guest['skills'])>0 )    
                        @foreach( $guest['skills'] as $skill)
                        <span class="label label-success"> {{ $skill->name }}</span>
                        @endforeach
                     @else
                        <p class="text-muted">
                             Not Added
                        </p>
                    @endif
                    </p>

                    <hr>

                    <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                    <p>{{ $user->description }}</p>
                @else
                    Profile is Private
                @endif
            </div>
            <!-- /.box-body -->
        </div>
    </div>

</div>
<script>
                            function follow()
                            {
                            var val = $('#dummy_status').val();
                                    var message = "";
                                    if (val == 0) {
                            message = "Do you want to cancel request ?"
                            }
                            else if (val == 1) {
                            message = "Do you want to Follow ?"
                            }
                            if (!confirm(message)) {
                            return false;
                            }
                            else {
                            $("#followForm").submit();
                            }
                            }
                    function accetpOrRejectFollow(id, status)
                    {
                    data = {'id':id, 'status':status};
                            var params = new Object();
                            params.data = data;
                            var callback_urgencyAdminJdReport = $.Callbacks();
                            callback_urgencyAdminJdReport.add(function takeAction(response)
                            {
                            location.reload();
                            });
                            var response = AjaxModule.postRequestReturnResponse('/user/accetpOrRejectFollow', 'POST', params, callback_urgencyAdminJdReport);
                            return false;
                    }
</script>
@endsection