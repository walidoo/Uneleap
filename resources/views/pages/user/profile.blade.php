@extends('layouts.master')
@section('content')
<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">

        <div class="box-body">
            <div class="page-content" style="min-height:602px">

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <!-- BEGIN PAGE HEADER-->
                <div class="right_col" role="main">
                    <div class="">
                        <div class="page-title">
                            <div class="title_left">
                                <h3>Profile Details <small></small></h3>
                            </div>

                        </div>

                        <!-- END PAGE HEADER-->

                        <hr>
                        <div class="col-md-12 col-sm-12" >

                            <!-- Profile Image -->
                            <div class="box box-primary" data-toggle="modal" data-target="#myModalpic">
                                <div class="box-body box-profile" 
                                     style="background: <?php if (!empty($user->profile_cover_path)) { ?>
                                     url('{{$user->profile_cover_path}}'); <?php } ?>
                                     background-size:cover; opacity: 1.0;">
                                    <p class="text-muted text-center" >
                                    <form action="{{ url('update_user_info') }}" method="post" enctype="multipart/form-data">




                                    </form>
                                    </p>
                                    <div class="col-md-8 col-md-offset-2">

                                        <img  <?php if (!empty($user->profile_picture_path)) { ?> src="{{$user->profile_picture_path}}" <?php } else { ?>src="/uploads/afowode@my.fit.edu.jpg"   <?php } ?>
                                                                                                  class="profile-user-img img-responsive img-circle" alt="User Image">

                                        <p class="text-muted text-center" style="color:#fff"></p>
                                    </div>



                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->


                            <div class="main-wrapper">
                                <section class="section summary-section">
                                    <h2 class="section-title" onMouseOver="show_sidebar('pro_sum')"     onMouseOut="hide_sidebar('pro_sum')"><i class="fa fa-user"></i> Summary <div id='pro_sum' style='display:none;float:left'><label class="btn glyphicon glyphicon-pencil" > 
                                                <input name="avatar"  data-toggle="modal" data-target="#myModal"  type="button" style="display: none;">
                                            </label><label class="btn glyphicon glyphicon-paperclip"> <input name="avatar" type="file" style="display: none;"></label></div></h2>
                                    <div class="intro" >
                                        <p id='profile_intro'>
                                            Creating an educational family one institution at a time											

                                        </p>
                                    </div>
                                    <div class="summary" style="width:1050px">
                                        <p></p>
                                    </div><!--//summary-->
                                </section>

                                <section class="section experiences-section">
                                    <h2 class="section-title" onMouseOver="show_sidebar('edu_sum')"     onMouseOut="hide_sidebar('edu_sum')"><i class="fa fa-briefcase"></i>Experiences<div id="edu_sum" style='display:none;float:left'><label class="btn glyphicon glyphicon-plus">
                                                <input name="avatar"  id='experiences-section-add'  type="button" style="display: none;">
                                            </label> </div>
                                    </h2>
                                    <div class="intro" id='exp_intro'>
                                        @foreach($user['experiences'] as $experience)
                                        <div class="item">
                                            <div class="meta">
                                                <div class="upper-row">
                                                    <h3 class="job-title">{{ $experience->job_title}}<label class="btn glyphicon glyphicon-pencil">
                                                            <input name="avatar"  onclick="send_data('{{$experience}}')";   type="button" style="display: none;">
                                                        </label></h3>
                                                    <div class="time">{{ $experience->date_from}} - <?php if ($experience->is_currently_working == 1) { ?> Present<?php } else { ?>  {{$experience->date_to}} <?php } ?></div>
                                                </div><!--//upper-row-->
                                                <div class="company">{{ $experience->company_name}} </div>
                                                <label>
                                                    Project: <span>{{$experience->project_title}}</span>
                                                </label>
                                            </div><!--//meta-->
                                            <div class="details">
                                                <p>{{ $experience->description}}</p>

                                            </div><!--//details-->
                                        </div><!--//item-->
                                        @endforeach
                                    </div>



                                </section><!--//section-->
                                <section class="skills-section section">
                                    <h2 class="section-title" onMouseOver="show_sidebar('skl_sum')"     onMouseOut="hide_sidebar('skl_sum')"><i class="fa fa-rocket"></i>Skills &amp; Proficiency
                                        <div id='skl_sum' style='display:none;float:left'> <label class="btn glyphicon glyphicon-plus">
                                                <input name="avatar"  id='skill-section-id' type="button" style="display: none;">
                                            </label>

                                        </div>
                                    </h2>
                                    <div class="skillset" id='skill_intro'>

                                        @foreach($user['skills'] as $skill )
                                        <div class="item">
                                            <h3 class="level-title">{{$skill->name}}<label class="btn glyphicon glyphicon-pencil">
                                                    <input name="avatar"  onclick="send_data_skill('{{ $skill}}')";   type="button" style="display: none;">
                                                </label></h3>

                                            <div class="progress progress-sm active">
                                                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" skill-val="{{$skill->percentage}}" style="width: {{$skill->percentage}}%">
                                                    <span class="sr-only">20% Complete</span>
                                                </div>
                                            </div>
                                            <!--//level-bar-->

                                        </div><!--//item-->
                                        @endforeach
                                </section><!--//skills-section-->


                                <!--//educattion-section-->
                                <section class="section education-section">
                                    <h2 class="section-title" onMouseOver="show_sidebar('ed_sum')"     onMouseOut="hide_sidebar('ed_sum')"><i class="fa fa-university"></i>Education
                                        <div id='ed_sum' style='display:none;float:left'> <label class="btn glyphicon glyphicon-plus">
                                                <input name="avatar"  id="education-section-add"  type="button" style="display: none;">
                                            </label>
                                            <label class="btn glyphicon glyphicon-paperclip"> <input name="avatar" type="file" style="display: none;"></label> </div>
                                    </h2>

                                    <div class="intro" id='eduction_intro'>

                                        @foreach( $user['educations'] as $education ) 
                                        <div class="item">
                                            <div class="meta">
                                                <div class="upper-row">
                                                    <h3 class="job-title">{{ $education->field_of_study }} <label class="btn glyphicon glyphicon-pencil">
                                                            <input name="avatar"  onclick="send_data_edu('{{$education}}')";  type="button" style="display: none;">
                                                        </label></h3>
                                                    <div class="time">{{ $education->starting_year }} - <?php if (!empty($education->is_current)) { ?>  Present  <?php } else { ?>{{$education->ending_year}} <?php } ?></div>
                                                </div><!--//upper-row-->
                                                <div class="company">{{ $education->school_name }}</div>
                                            </div><!--//meta-->
                                            <div class="details">

                                                <p>{{ $education->description }}</p>
                                                <p>{{ $education->activities }}</p>

                                            </div><!--//details-->
                                        </div><!--//item-->
                                        @endforeach
                                    </div>




                                </section><!--//section education-->





                                <!-- Modal -->

                                <!-- Modal -->
                                <div class="modal fade" id="myModalpic" role="dialog">
                                    <div class="modal-dialog" >

                                        <!-- Modal content-->
                                        <div class="modal-content">

                                            <div class="modal-body">

                                                <legend>Profile Picture Details</legend>
                                                <div id="messagebox"  class="messagetext" ></div>

                                                <fieldset>
                                                    <div class="container">

                                                        <ul class="nav nav-pills">
                                                            <li class="active"><a data-toggle="pill" href="#home">Profile Page Image</a></li>
                                                            <li><a data-toggle="pill" href="#menu1">Background Page</a></li>

                                                        </ul>

                                                        <div class="tab-content">
                                                            <div id="home" class="tab-pane fade in active">
                                                                <div class="container">


                                                                    <div id="preview"><img src="/public/no-image.jpg" /></div>
                                                                    `
                                                                    <form id="form" method="POST" action="{{ url('/user_profile/picture') }}" enctype="multipart/form-data">
                                                                        {{ csrf_field() }}
                                                                        <input id="uploadImage" type="file" accept="image/*" name="image" />
                                                                        <input id="button" type="submit" value="Upload">
                                                                    </form>
                                                                    <div id="err"></div>


                                                                </div>




                                                            </div>
                                                            <div id="menu1" class="tab-pane fade">
                                                                <div class="container">


                                                                    <div id="preview_back"><img src="/public/no-image.jpg" /></div>

                                                                    <form id="form" method="POST" action="{{ url('/user_profile/picture') }}" enctype="multipart/form-data">
                                                                        {{ csrf_field() }}
                                                                        <input id="uploadImage" type="file" accept="image/*" name="cover" />
                                                                        <input id="button" type="submit" value="Upload">
                                                                    </form>
                                                                    <div id="err_back"></div>


                                                                </div>



                                                            </div>




                                                        </div>




                                                </fieldset>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" onClick="loaddata()">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog" >

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-body">

                                                <legend>Profile Details</legend>
                                                <div id="messagebox_profile_sum"  class="messagetext" ></div>
                                                <fieldset>
                                                    <form id='proForm' method="POST" action="{{ url('/user_profile/summary') }}" >
                                                        {{ csrf_field() }}
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Description</label>
                                                            <div class="col-md-9">
                                                                <textarea  name='profile_summary' class="form-control"  rows="9">{{ $user->profile_summary }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                                                                <input id="btn_add_pro" name="btn_add_pro" type="submit" class="btn btn-primary" value="Save"  />
                                                                <input id="btn_cancel" name="btn_cancel" type="reset"  class="btn btn-danger" value="Cancel" />
                                                            </div>
                                                        </div>
                                                    </form>
                                                </fieldset>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" onClick="loaddata()">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal fade" id="myModal2" role="dialog">
                                    <div class="modal-dialog" >

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-body">

                                                <legend>Experience Details</legend>
                                                <div id="messagebox_exper"  class="messagetext" ></div>
                                                <fieldset>
                                                    <form id="ExpForm"  method="POST" action="{{ url('/user_profile/experience') }}" > 
                                                        {{ csrf_field() }}

                                                        <input type="hidden" name="exp_update_key" value='0'>
                                                        <input type="hidden" name="exp_id">
                                                        <div class="form-group">
                                                            <div class="row colbox">

                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeeno" class="control-label">Company Name</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <input id="company_name" name="company_name" placeholder="Company Name" type="text" class="form-control validate[required]"  value="" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row colbox">
                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeename" class="control-label">Job Title</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <input id="job_title" name="job_title" placeholder="Title" type="text" class="form-control validate[required]"  value="" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>

                                                            <div class="row colbox">
                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeename" class="control-label">Project Title</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <input id="job_title" name="project_title" placeholder="Project Title" type="text" class="form-control validate[required]"  value="" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row colbox">
                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeename" class="control-label">Location</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <input id="location" name="location" placeholder="Location" type="text" class="form-control validate[required]"  value="" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row colbox">
                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeename" class="control-label">Time Period</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <ul><li class="start-date">
                                                                            <select class="validate[required]" aria-describedby="month-startDate-position-editPositionForm-error" type="singleselect" id="month-startDate-position-editPositionForm" name="starting_month"><option selected="selected" value="">Choose...</option><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select><label for="year-startDate-position-editPositionForm" id="control_gen_54" style="display: none;">Year</label><script class="li-control" type="text/javascript+initialized" id="controlinit-dust-client-36">LI.Controls.addControl("control-dust-client-36", "GhostLabel", {})</script><input type="text" data-ime-mode-disabled="" class="year validate[required]" maxlength="4" id="year-startDate-position-editPositionForm" value="" name="starting_year" placeholder="Year"><span class="to">&ndash;</span></li><li class="end-date"><div class="ended-position">
                                                                                <select  aria-describedby="month-monthYear-endDate-position-editPositionForm-error" type="singleselect" id="month-monthYear-endDate-position-editPositionForm" name="ending_month"><option selected="selected" value="">Choose...</option><option value="1">January</option><option value="2">February</option><option value="3">March</option><option value="4">April</option><option value="5">May</option><option value="6">June</option><option value="7">July</option><option value="8">August</option><option value="9">September</option><option value="10">October</option><option value="11">November</option><option value="12">December</option></select><label for="year-monthYear-endDate-position-editPositionForm" id="control_gen_55" style="display: none;">Year</label><script class="li-control" type="text/javascript+initialized" id="controlinit-dust-client-37">LI.Controls.addControl("control-dust-client-37", "GhostLabel", {})</script><input type="text" data-ime-mode-disabled="" class="year" maxlength="4" id="year-monthYear-endDate-position-editPositionForm" value="" name="ending_year" placeholder="Year"></div><div class="current-position">Present</div><label id="still-here" class="checkbox">
                                                                                <input type="checkbox" name="is_currently_working" class="experience-still-here-checkbox" id="isCurrent-endDate-position-editPositionForm"  >I currently work here</label></li></ul>
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="row colbox">
                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeename" class="control-label">Description</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <textarea class="form-control validate[required]" name="description" rows="3"></textarea>
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                                                                <input id="btn_add_exper" name="btn_add_exper" type="submit" class="btn btn-primary" value="Save"  />
                                                                <input id="btn_cancel" name="btn_cancel" type="reset"  class="btn btn-warning" value="Cancel" />
                                                                <input id="btn_add_exper_del" name="btn_add_exper_del" type="button" class="btn btn-danger" value="Delete"  style='display:none' />

                                                            </div>
                                                        </div>
                                                    </form>
                                                </fieldset>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" onClick="loaddata()">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>                      

                                <div class="modal fade" id="myModal4" role="dialog">
                                    <div class="modal-dialog"  >

                                        <!-- Modal content-->
                                        <div class="modal-content">
                                            <div class="modal-body">

                                                <legend>Skill Details</legend>
                                                <div id="messagebox_skill"  class="messagetext" ></div>
                                                <fieldset>
                                                    <form id="skillForm"  method="POST" action="{{ url('user_profile/skill') }}" >
                                                        {{ csrf_field() }}
                                                        <input type='hidden' id='skill_update_key'  name='skill_update_key' value='0' >
                                                        <input type='hidden' id='skill_id'  name='skill_id' value='0' >	

                                                        <div class="form-group">
                                                            <div class="row colbox">

                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeeno" class="control-label">Skill Name</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <input id="skill_name" name="name" placeholder="Skill Name" type="text" class="form-control validate[required]"  value="" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--div class="form-group">
                                                            <div class="row colbox">

                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeeno" class="control-label">Skill Summary</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <textarea class="form-control validate[required]" name="description" rows="8" placeholder="Skill List.."></textarea>
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div!-->
                                                        <div class="form-group">
                                                            <div class="row colbox">

                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeeno" class="control-label">Percentage for skill assessment</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <input id="weightage" name="percentage" placeholder="Out of 100" type="text" class="form-control validate[required,custom[integer],min[0],max[100]]"  value="" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                                                                <input id="btn_add_skill" name="btn_add_skill" type="submit" class="btn btn-primary" value="Save"  />

                                                                <input id="btn_cancel" name="btn_cancel" type="reset"  class="btn btn-danger" value="Cancel" />
                                                                <input id="btn_add_skill_del" name="btn_add_edu_del" type="button" class="btn btn-danger" value="Delete"  style='display:none' />


                                                            </div>
                                                        </div>

                                                    </form>

                                                </fieldset>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" onClick="loaddata()">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="modal fade" id="myModal_edu" role="dialog">
                                    <div class="modal-dialog" >

                                        <!-- Modal content-->
                                        <div class="modal-content">

                                            <div class="modal-body">

                                                <legend>Education Details</legend>
                                                <div id="messagebox_edu"  class="messagetext" ></div>

                                                <fieldset>
                                                    <form id="eduForm" method="POST" action="{{ url('/user/university/store') }}" >
                                                        {{ csrf_field() }}
                                                        <input type='hidden' id='education_update_key'  name='education_update_key' value='0' >
                                                        <input type='hidden' id='education_id'  name='education_id' value='0' >	
                                                        <div class="form-group">
                                                            <div class="row colbox">

                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeeno" class="control-label">School Name</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <input id="school_name" name="school_name" placeholder="School Name" type="text" class="form-control validate[required]"  value="" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row colbox">
                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeename" class="control-label">Field of Study</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <input id="field_of_study" name="field_of_study" placeholder="Field of Study" type="text" class="form-control validate[required]"  value="" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row colbox">
                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeename" class="control-label">Grade</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <input id="grade" name="grade" placeholder="Grade" type="text" class="form-control validate[required]"  value="" />
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="row colbox">
                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeename" class="control-label">Dates Attended</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <ul><li class="start-date"><label for="year-startDate-position-editPositionForm" id="control_gen_54" style="display: none;">Year</label><script class="li-control" type="text/javascript+initialized" id="controlinit-dust-client-36">LI.Controls.addControl("control-dust-client-36", "GhostLabel", {})</script>
                                                                            <input type="text" data-ime-mode-disabled="" class="year validate[required,custom[integer]]" maxlength="4" id="year-startDate-position-editPositionForm" value="" name="starting_year" placeholder="Year">
                                                                            <span class="to">&ndash;</span></li><li class="end-date"><div class="ended-position"><label for="year-monthYear-endDate-position-editPositionForm" id="control_gen_55" style="display: none;">Year</label><script class="li-control" type="text/javascript+initialized" id="controlinit-dust-client-37">LI.Controls.addControl("control-dust-client-37", "GhostLabel", {})</script>
                                                                                <input type="text" data-ime-mode-disabled="" class="year validate[custom[integer]]" maxlength="4" id="year-monthYear-endDate-position-editPositionForm" value="" name="ending_year" placeholder="Year"></div><div class="current-position">Present</div><label id="still-here" class="checkbox">
                                                                                <input type="checkbox" class="experience-still-here-checkbox" id="isCurrent-endDate-position-editPositionForm" value="is_current" name="is_current">Or expected graduation year</label></li></ul>
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <div class="row colbox">
                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeename" class="control-label">Activities and Societies</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <textarea class="form-control validate[required]" name="activities" rows="3"></textarea>
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <div class="row colbox">
                                                                <div class="col-lg-4 col-sm-4">
                                                                    <label for="employeename" class="control-label">Description</label>
                                                                </div>
                                                                <div class="col-lg-8 col-sm-8">
                                                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                                                    <span class="text-danger"></span>
                                                                </div>
                                                            </div>
                                                        </div>



                                                        <div class="form-group">
                                                            <div class="col-sm-offset-4 col-lg-8 col-sm-8 text-left">
                                                                <input id="btn_add_edu" name="btn_add_edu" type="submit" class="btn btn-primary" value="Save"  />
                                                                <input id="btn_cancel" name="btn_cancel" type="reset"  class="btn btn-danger" value="Cancel" />
                                                                <input id="btn_add_edu_del" name="btn_add_edu_del" type="button" class="btn btn-danger" value="Delete"  style='display:none' />
                                                            </div>
                                                        </div>
                                                    </form>
                                                </fieldset>

                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal" onClick="loaddata()">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>















                            </div>
                        </div>
                        <!-- /.box-body -->

                        <!-- /.box-footer-->
                    </div>

                    <!-- /.box -->

                    </section>


                    <div class="control-sidebar-bg"></div>

                </div>
                <!-- ./wrapper -->

                </body>
                </html>
                <script type="text/javascript">
                                                    function show_sidebar(x)
                                                    {
                                                    document.getElementById(x).style.display = "block";
                                                    }

                                            function hide_sidebar(x)
                                            {
                                            document.getElementById(x).style.display = "none";
                                            }

                                            function send_data(experience)
                                            {
                                            var experience = JSON.parse(experience);
                                                    var start = experience['date_from'].split(",");
                                                    var end = experience['date_to'].split(",");
                                                    /*       $('#ExpForm').find('input[name="ending_month"]').value  = (new Date(end[0]+'-1-01').getMonth()+1);
                                                     */
                                                    $('#ExpForm').find('input[name="ending_year"]').val(end[1]);
                                                    $('#ExpForm').find('input[name="job_title"]').val(experience['job_title']);
                                                    $('#ExpForm').find('input[name="company_name"]').val(experience['company_name']);
                                                    $('#ExpForm').find('input[name="starting_year"]').val(start[1]);
                                                    $('#ExpForm').find('input[name="location"]').val(experience['location']);
                                                    $('#ExpForm').find('textarea[name="description"]').val(experience['description']);
                                                    $('#ExpForm').find('input[name="project_title"]').val(experience['project_title']);
                                                    $('#ExpForm').find('input[name="exp_update_key"]').val(1);
                                                    $('#ExpForm').find('input[name="exp_id"]').val(experience['id']);
                                                    $('#btn_add_exper_del').css("display", "");
                                                    $('#myModal2').modal({
                                            show: 'true'
                                            });
                                            }

                                            $("#experiences-section-add").click(function () {
                                            $('#ExpForm').find('input[name="job_title"]').val('');
                                                    $('#ExpForm').find('input[name="company_name"]').val('');
                                                    $('#ExpForm').find('input[name="starting_year"]').val('');
                                                    $('#ExpForm').find('input[name="ending_year"]').val('');
                                                    $('#ExpForm').find('input[name="location"]').val('');
                                                    $('#ExpForm').find('input[name="starting_month"]').val('');
                                                    $('#ExpForm').find('input[name="ending_month"]').val('');
                                                    $('#ExpForm').find('textarea[name="job_desc"]').val('');
                                                    $('#ExpForm').find('input[name="exp_update_key"]').val('');
                                                    $('#ExpForm').find('input[name="is_current"]').prop('checked', false);
                                                    $('#btn_add_exper_del').css("display", "none");
                                                    $('#myModal2').modal({
                                            show: 'true'
                                            });
                                            });
                                                    $("#btn_add_exper_del").click(function () {

                                            //	alert($('#exp_update_key').val());awais
                                            if (!confirm("Do you want to delete")) {
                                            return false;
                                            }
                                            else {
                                            data = {'exp_id':$('#ExpForm').find('input[name="exp_id"]').val()};
                                                    var params = new Object();
                                                    params.data = data;
                                                    var callback_urgencyAdminJdReport = $.Callbacks();
                                                    callback_urgencyAdminJdReport.add(function takeAction(response)
                                                    {
                                                    location.reload();
                                                    });
                                                    var response = AjaxModule.postRequestReturnResponse('/user_profile/experience/delete', 'POST', params, callback_urgencyAdminJdReport);
                                                    return false;
                                                    
                                            }

                                            });
                                                    $("#education-section-add").click(function () {
                                            $('#eduForm').find('input[name="school_name"]').val('');
                                                    $('#eduForm').find('input[name="field_of_study"]').val('');
                                                    $('#eduForm').find('textarea[name="activities_desc"]').val('');
                                                    $('#eduForm').find('input[name="starting_year"]').val('');
                                                    $('#eduForm').find('input[name="ending_year"]').val('');
                                                    $('#eduForm').find('input[name="is_current"]').prop('checked', false);
                                                    $('#eduForm').find('input[name="ending_month"]').val('');
                                                    $('#eduForm').find('input[name="grade"]').val('');
                                                    $('#eduForm').find('textarea[name="edu_desc"]').val('');
                                                    $('#eduForm').find('input[name="edu_update_key"]').val('');
                                                    $('#btn_add_edu_del').css("display", "none");
                                                    $('#myModal_edu').modal({
                                            show: 'true'
                                            });
                                            });
                                                    function send_data_edu(education)
                                                    {
                                                    //awais
                                                    var education = JSON.parse(education);
                                                            $('#eduForm').find('input[name="school_name"]').val(education['school_name']);
                                                            $('#eduForm').find('input[name="field_of_study"]').val(education['field_of_study']);
                                                            $('#eduForm').find('textarea[name="activities"]').val(education['activities']);
                                                            $('#eduForm').find('input[name="starting_year"]').val(education['starting_year']);
                                                            $('#eduForm').find('input[name="ending_year"]').val(education['ending_year']);
                                                            $('#eduForm').find('textarea[name="description"]').val(education['description']);
                                                            $('#eduForm').find('input[name="grade"]').val(education['grade']);
                                                            $('#eduForm').find('input[name="education_update_key"]').val(1);
                                                            $('#eduForm').find('input[name="education_id"]').val(education['id']);
                                                            if (education['is_current'] == 1) {
                                                    $('#eduForm').find('input[name="is_current"]').prop('checked', true);
                                                    }

                                                    $('#btn_add_edu_del').css("display", "");
                                                            $('#myModal_edu').modal({
                                                    show: 'true'
                                                    });
                                                    }


                                            $("#btn_add_edu").click(function () {

                                            $.post("test.php", $('#eduForm').serialize(), function (data) {
                                            //alert(data);
                                            var response = data.split('$$$');
                                                    if (response[0] == 1) {

                                            $("#messagebox_edu").fadeTo(200, 0.1, function () {  //start fading the messagebox


                                            $(this).html('Data Added Successfully').addClass('messageboxsuccess').fadeTo(900, 1);
                                                    $("#eduction_intro").html(response[1]);
                                            });
                                            }
                                            });
                                            });
                                                    $("#btn_add_edu_del").click(function () {

                                            //	alert($('#exp_update_key').val());
                                            if (!confirm("Do you want to delete")) {
                                            return false;
                                            }
                                            else {

                                            data = {'education_id':$('#eduForm').find('input[name="education_id"]').val()};
                                                    var params = new Object();
                                                    params.data = data;
                                                    var callback_urgencyAdminJdReport = $.Callbacks();
                                                    callback_urgencyAdminJdReport.add(function takeAction(response)
                                                    {
                                                    location.reload();
                                                    });
                                                    var response = AjaxModule.postRequestReturnResponse('/user_profile/education/delete', 'POST', params, callback_urgencyAdminJdReport);
                                                    return false;
                                            }

                                            });
                                                    $("#projects-section-id").click(function () {
                                            $('#prjForm').find('input[name="prj_title"]').val('');
                                                    $('#prjForm').find('input[name="company_name"]').val('');
                                                    $('#prjForm').find('input[name="starting_year"]').val('');
                                                    $('#prjForm').find('input[name="ending_year"]').val('');
                                                    $('#prjForm').find('input[name="location"]').val('');
                                                    $('#prjForm').find('input[name="starting_month"]').val('');
                                                    $('#prjForm').find('input[name="ending_month"]').val('');
                                                    $('#prjForm').find('textarea[name="prj_desc"]').val('');
                                                    $('#prjForm').find('input[name="prj_update_key"]').val('');
                                                    $('#prjForm').find('input[name="is_current"]').prop('checked', false);
                                                    $('#btn_add_prj_del').css("display", "none");
                                                    $('#myModal3').modal({
                                            show: 'true'
                                            });
                                            });
                                                    function send_data_prj(id)
                                                    {
                                                    var response = "";
                                                            var dataString = 'prj_id=' + id;
                                                            $.ajax({
                                                            type: "POST",
                                                                    url: "ajaxsubmit.php",
                                                                    data: dataString,
                                                                    cache: false,
                                                                    success: function (result) {
                                                                    //alert(result);

                                                                    var response = result.trim().split('###');
                                                                            $('#prjForm').find('input[name="prj_title"]').val(response[2]);
                                                                            $('#prjForm').find('input[name="company_name"]').val(response[0]);
                                                                            $('#prjForm').find('input[name="starting_year"]').val(response[4]);
                                                                            $('#prjForm').find('input[name="ending_year"]').val(response[6]);
                                                                            $('#prjForm').find('input[name="location"]').val(response[1]);
                                                                            $('#prjForm').find('input[name="starting_month"]').val(response[3]);
                                                                            $('#prjForm').find('input[name="ending_month"]').val(response[5]);
                                                                            $('#prjForm').find('textarea[name="prj_desc"]').val(response[8]);
                                                                            $('#prjForm').find('input[name="prj_update_key"]').val(id);
                                                                            if (response[7] != null) {
                                                                    $('#prjForm').find('input[name="is_current"]').prop('checked', true);
                                                                            ;
                                                                    }


                                                                    $('#btn_add_prj_del').css("display", "");
                                                                            $('#myModal3').modal({
                                                                    show: 'true'
                                                                    });
                                                                    }
                                                            });
                                                    }

                                            $("#btn_add_prj").click(function () {

                                            $.post("test.php", $('#prjForm').serialize(), function (data) {
                                            //alert(data);
                                            var response = data.split('$$$');
                                                    if (response[0] == 1) {

                                            $("#messagebox_prj").fadeTo(200, 0.1, function () {  //start fading the messagebox


                                            $(this).html('Data Saved Successfully').addClass('messageboxsuccess').fadeTo(900, 1);
                                                    $("#prj_intro").html(response[1]);
                                            });
                                            }
                                            });
                                            });
                                                    $("#btn_add_prj_del").click(function () {

                                            //	alert($('#exp_update_key').val());
                                            if (!confirm("Do you want to delete")) {
                                            return false;
                                            }
                                            else {

                                            $.post("del.php", $('#prjForm').serialize(), function (data) {
                                            // alert(data);
                                            var response = data.split('$$$');
                                                    if (response[0] == 1) {

                                            $("#messagebox_prj").fadeTo(200, 0.1, function () {  //start fading the messagebox


                                            $(this).html('Data is Deleted Successfully').addClass('messageboxerror').fadeTo(900, 1);
                                                    $("#prj_intro").html(response[1]);
                                            });
                                            }
                                            });
                                            }

                                            });
                                                    $("#skill-section-id").click(function () {
                                            $('#skillForm').find('input[name="skill_name"]').val('');
                                                    $('#skillForm').find('textarea[name="skill_summary"]').val('');
                                                    $('#skillForm').find('input[name="weightage"]').val('');
                                                    $('#myModal4').modal({
                                            show: 'true'
                                            });
                                            });
                                                    function send_data_skill(skill)
                                                    {
                                                    var skill = JSON.parse(skill);
                                                            $('#skillForm').find('textarea[name="description"]').val(skill['description']);
                                                            $('#skillForm').find('input[name="name"]').val(skill['name']);
                                                            $('#skillForm').find('input[name="percentage"]').val(skill['percentage']);
                                                            $('#skillForm').find('input[name="skill_update_key"]').val(1);
                                                            $('#skillForm').find('input[name="skill_id"]').val(skill['id']);
                                                            $('#btn_add_skill_del').css("display", "");
                                                            $('#myModal4').modal({
                                                    show: 'true'
                                                    });
                                                    }

                                            $("#btn_add_skill").click(function () {

                                            $.post("test.php", $('#skillForm').serialize(), function (data) {
                                            //alert(data);
                                            var response = data.split('$$$');
                                                    if (response[0] == 1) {

                                            $("#messagebox_skill").fadeTo(200, 0.1, function () {  //start fading the messagebox


                                            $(this).html('Data Added Successfully').addClass('messageboxsuccess').fadeTo(900, 1);
                                                    $("#skill_intro").html(response[1]);
                                            });
                                            }
                                            });
                                            });
                                                    $("#btn_add_skill_del").click(function () {

                                            if (!confirm("Do you want to delete")) {
                                            return false;
                                            }
                                            else {

                                            data = {'skill_id':$('#skillForm').find('input[name="skill_id"]').val()};
                                                    var params = new Object();
                                                    params.data = data;
                                                    var callback_urgencyAdminJdReport = $.Callbacks();
                                                    callback_urgencyAdminJdReport.add(function takeAction(response)
                                                    {
                                                    location.reload();
                                                    });
                                                    var response = AjaxModule.postRequestReturnResponse('/user_profile/skill/delete', 'POST', params, callback_urgencyAdminJdReport);
                                                    return false;
                                            }

                                            });</script>
                <style>
                    .messageboxsuccess {
                        background-color:green;
                        color:white;
                        text-align:center;

                    }

                    .messageboxerror {
                        background-color:red;
                        color:white;
                        text-align:center;

                    }
                </style>

                <script type="text/javascript">
                                                    jQuery(document).ready(function () {
                                            jQuery('#ExpForm').validationEngine();
                                                    jQuery('#skillForm').validationEngine();
                                                    jQuery('#eduForm').validationEngine();
                                            });
                </script>

                @endsection