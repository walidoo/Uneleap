@extends('layouts.master')
@section('content')

<section class="content">

    @if(!empty($university))
    <div class="row">
        <div class="col-md-3">

            <!-- Profile Image -->
            <div class="box box-primary">
                <div class="box-body box-profile" style="background:url()">

                    <img src="{{ URL::asset('public/'.$university->profile) }}" class="profile-user-img img-responsive img-circle" alt="User Image">

                    <h3 class="profile-username text-center">{{ $university->name   }}</h3>

                    <p class="text-muted text-center"></p>

                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

            <!-- About Me Box -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">About University</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <strong><i class="fa fa-book margin-r-5"></i>Tag Line</strong>

                    <p class="text-muted">
                        {{$university->tag_line }}
                    </p>

                    <hr>


                    <strong><i class="fa fa-book margin-r-5"></i>Address</strong>

                    <p class="text-muted">
                        {{$university->address }}
                    </p>

                    <hr>	
                    <strong><i class="fa fa-book margin-r-5"></i> Phone</strong>


                    <p class="text-muted">
                        {{ $university->phone  }}
                    </p>

                    <hr>

                    <strong><i class="fa fa-map-marker margin-r-5"></i> Email</strong>


                    <p class="text-muted"> {{$university->email }} </p>

                    <hr>
                    <strong><i class="fa fa-map-marker margin-r-5"></i> Website</strong>


                    <p class="text-muted">
                        <a target="_blank" href="{{$university->website }}"> {{$university->website }} </a>
                    </p>

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
                        <li class="newsTab"><a href="#tab_3" data-toggle="tab" aria-expanded="false">News</a></li>
                        <li class="membersTab"><a href="#tab_2" data-toggle="tab" aria-expanded="false">Member</a></li>
                        <li class="generalInfoTab active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">General Info</a></li>
                        <li class="pull-left header"><i class="fa fa-th"></i></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <div class="box-group" id="accordion">
                                <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
                                <div class="panel box box-success">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" class="">
                                                Mission Statement
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" aria-expanded="true">
                                        <div class="box-body">
                                            {{$university->description1}}
                                        </div>
                                    </div>
                                </div>
                                <div class="panel box box-success">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed" aria-expanded="false">
                                                Highlight and Facts
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="box-body">
                                            {{$university->description2}}
                                        </div>
                                    </div>
                                </div>
                                <div class="panel box box-success">
                                    <div class="box-header with-border">
                                        <h4 class="box-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed" aria-expanded="false">
                                                History
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="box-body">
                                            {{$university->description3}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="tab_2">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Select User type: </label>
                                <select id="typeSelector"  name="type" class="form-contro">
                                    <option value="0">Select</option>
                                    <option value="1">Student</option>
                                    <option value="2">Faculty</option>
                                </select>
                            </div>
                            <div class="tab_2_Content">

                            </div>
                        </div>
                        <div class="tab-pane" id="tab_3">
                            <div class="tab_3_Content">
                                News
                            </div>
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
    @else
    <div class="row">
        <div class="col-md-10">

            <!-- Profile Image -->
            <div class="box box-primary">

                <b>There is no data about the university!</h4></b> 

            </div>
        </div>
    </div>
    @endif
</section>
<script>
    $(document).ready(function () {
        $(document).on('click', '.box-footer .pagination a', function (e)
        {
            var id = $("#typeSelector option:selected").val();
            getStudentOrFacultyPaginator($(this).attr('href').split('page=')[1], id);
            e.preventDefault();
        });
        $(document).on('click', '.universityNewsPaginator .pagination a', function (e)
        {
            getNewOfUniversityPaginator($(this).attr('href').split('page=')[1]);
            e.preventDefault();
        });
    });
    $("#typeSelector").change(function () {
        var id = $("#typeSelector option:selected").val();
        getStudentOrFacultyPaginator(1, id);

    });
    function getStudentOrFacultyPaginator(page, type)
    {
        var data = {'type': type};
        var params = new Object();
        params.data = data;
        var callback_listPlan = $.Callbacks();
        callback_listPlan.add(function takeAction(response)
        {
            if (response['status'] == 1)
            {
                $(".tab_2_Content").html(response['data']);
            }
            else if (response['response'] == "error")
            {
                alert("Some thing Went Wrong");
            }
        });
        var response = AjaxModule.postRequestReturnResponse('/user/getStudentOrFacultyPaginator?sort=created_at&page=' + page, 'POST', params, callback_listPlan);

    }
    function getNewOfUniversityPaginator(page)
    {
        var data = {};
        var params = new Object();
        params.data = data;
        var callback_listPlan = $.Callbacks();
        callback_listPlan.add(function takeAction(response)
        {
            if (response['status'] == 1)
            {
                $(".tab_3_Content").html(response['data']);
            }
            else if (response['status'] == 0)
            {
                alert("Some thing Went Wrong");
            }
        });
        var response = AjaxModule.postRequestReturnResponse('/user/getUniversityNews?sort=created_at&page=' + page, 'POST', params, callback_listPlan);

    }
    $(".newsTab").click(function () {
        getNewOfUniversityPaginator(1);
    });


</script>
@endsection