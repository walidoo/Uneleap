@extends('layouts.master')
@section('content')

<link rel="stylesheet" href="{{asset('plugins/fullcalendar/fullcalendar.min.css')}}">
<link rel="stylesheet" href="{{asset('plugins/fullcalendar/fullcalendar.print.css')}}" media="print">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/css/bootstrap-datetimepicker-standalone.min.css.map">
<link rel="stylesheet" href="{{asset('plugins/timepicker/bootstrap-timepicker.min.css')}}">

<!-- daterange picker -->
<link rel="stylesheet" href="{{asset('plugins/daterangepicker/daterangepicker.css')}}">
<!-- bootstrap datepicker -->
<link rel="stylesheet" href="{{asset('plugins/datepicker/datepicker3.css')}}">




<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 10px;">
            @if(isset($single))
            <!--a class="btn btn-warning btn-lg" href="/events">&lt;&lt; Back to All Events</a -->

            @endif
            @if (!$restrict_entry_permission)
            <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Add New Event</button>
            @endif
        </div>
        <div class="col-md-12" style="margin-bottom: 10px;">
            @if (!empty($errors->all()))
            <div class="alert alert-danger">
                <ul>

                    @foreach ($errors->all() as $message) 
                    <li>{{$message}}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
        <!-- <div class="col-md-3">
         
         
         </div><!-- /.col -->
         @if (!$restrict_entry_permission)
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-body no-padding">
                    <!-- THE CALENDAR -->
                    <div id="calendar55"></div>
                </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col -->
        @endif
        @if(isset($single))
        <div class="col-md-12">
            @foreach ($raw_events as $val)

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Event Detail</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table class="table table-bordered">
                        <tbody><tr>
                                <th>Name</th>
                                <th>Value</th>
                            </tr>
                            <tr>
                                <td>Cover</td>

                                <td><img src="{{($val->cover_photo)?($val->cover_photo):'http://placehold.it/200?text=No+Cover+Photo'}}" width="200" /></td>
                            </tr>
                            <tr>
                                <td>Title</td>

                                <td>{{$val->title}}</td>
                            </tr>
                            <tr>
                                <td>Start Date</td>

                                <td>{{$val->start_date}}</td>
                            </tr>
                            <tr>
                                <td>End Date</td>

                                <td>{{$val->end_date}}</td>
                            </tr>
                            <tr>
                                <td>Full Day</td>

                                <td>{{$val->full_day?"Yes":"No"}}</td>
                            </tr>
                            <tr>
                                <td>Public Event</td>

                                <td>{{$val->public?"Public":"Private"}}</td>
                            </tr>
                            <tr>
                                <td>Cost</td>

                                <td>${{$val->cost}}</td>
                            </tr>

                            <tr>
                                <td>description</td>

                                <td>{{$val->description}}</td>
                            </tr>

                            @if($user->id != $val->user_id )
                                <tr>
                                    <td>Book Event</td>

                                    <td>
                                        @if(!in_array($user->id, array_pluck($val['bookings'], 'user_id')) )
                                         <a href="/event/booking/{{ \encrypt($val->id) }}" style="cursor: pointer;">Book</a>
                                        @else
                                            Already Booked
                                        @endif
                                    </td>
                                </tr>
                            @endif

                            <tr>
                                <td>Attachments</td>
                                <?php $lnk = "<a href='{$val->attachments}' >Download</a>"; ?>
                                <td><?= ($val->attachments) ? $lnk : "No Attachments" ?></td>
                            </tr>
                        </tbody></table>
                </div>
                <!-- /.box-body -->

            </div>
            @endforeach
        </div>
        @else
        <div class="col-md-12">
            <ul class="timeline">
                <?php $current_date = false ?>
                <!-- timeline time label -->
                @foreach ($events as $value)

                @if ($current_date != date('d/m/y',strtotime($value->start_date)) )
                <li class="time-label">
                    <span class="bg-red">
                        {{date('l jS \of F Y',strtotime($value->start_date))}}
                    </span>
                </li>
                @endif
                <!-- /.timeline-label -->

                <!-- timeline item -->
                <li>
                    <!-- timeline icon -->
                    <i class="fa fa-calendar bg-blue"></i>
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i>  {{date('h:i:s A',strtotime($value->start_date))}}</span>

                        <h3 class="timeline-header"><a href="#">{{$value->title}}</a> ...</h3>

                        <div class="row">
                            <div class="timeline-body">
                                <div class="col-md-3"><img src="{{($value->cover_photo)?($value->cover_photo):'http://placehold.it/200?text=No+Cover+Photo'}}" width="100" /></div>
                                <div class="col-md-9">{{$value->description}}</div>

                            </div>


                            <div class="timeline-footer col-md-12">
                                <?php $lnk = "<a href='{$value->attachments}' class='btn btn-primary btn-xs' >Download Attachment</a>"; ?>
                                <?= ($value->attachments) ? $lnk : "" ?>
                                <a class="btn btn-primary btn-xs" href="/events/{{$value->id}}">View Event</a>
                            </div>
                        </div>
                    </div>
                </li>
                <?php $current_date = date('d/m/y', strtotime($value->start_date)) ?>
                <!-- END timeline item -->
                @endforeach

                ...

            </ul>
        </div>
        @endif
    </div><!-- /.row -->
</section><!-- /.content -->

<!-- /.box -->
<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="{{asset('plugins/fullcalendar/fullcalendar.min.js')}}"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.43/js/bootstrap-datetimepicker.min.js"></script>
<script src="{{asset('plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('plugins/datepicker/bootstrap-datepicker.js')}}"></script>
<!-- Page specific script -->
<script>
        $(document).ready(function() {

$("#st_timepicker").timepicker({
showInputs: false
});
        $("#et_timepicker").timepicker({
showInputs: false
});
        $('#calendar55').fullCalendar({
@if (isset($single))
        events: <?= $events ?>,
        @else
        events: '/get_calendar',
        @endif
        header: {
        left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
        },
        editable: true,
        droppable: true,
// draggable: true,
        slotDuration: '00:30:00',
        eventReceive: function(event){
        var title = event.title;
                var start = event.start.format("YYYY-MM-DD[T]HH:mm:SS");
                $.ajax({
                url: '/events',
                        data: 'type=new&title=' + title + '&startdate=' + start + '&zone=' + zone,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response){
                        event.id = response.eventid;
                                $('#calendar55').fullCalendar('updateEvent', event);
                        },
                        error: function(e){
                        console.log(e.responseText);
                        }
                });
                $('#calendar55').fullCalendar('updateEvent', event);
                console.log(event);
        },
        eventDrop: function(event, delta, revertFunc) {
        var title = event.title;
                var start = event.start.format();
                var end = (event.end == null) ? start : event.end.format();
                // alert("event drop");
                $.ajax({
                url: '/modify_entry',
                        data: 'type=resetdate&title=' + title + '&start=' + start + '&end=' + end + '&eventid=' + event.id + '&_token=' + Laravel.csrfToken,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response){
                        if (response.status != 'success')
                                revertFunc();
                        },
                        error: function(e){
                        revertFunc();
                                alert('Error processing your request: ' + e.responseText);
                        }
                });
        },
        eventClick: function(event, jsEvent, view) {
        // console.log(event.id);
        //   var title = prompt('Event Title:', event.title, { buttons: { Ok: true, Cancel: false} });
        //   if (title){
        //       event.title = title;
        //       // console.log('type=changetitle&title='+title+'&eventid='+event.id);
        //       $.ajax({
        //             url: '/modify_entry',
        //             data: 'type=changetitle&title='+title+'&eventid='+event.id+'&_token='+Laravel.csrfToken,
        //             type: 'POST',
        //             dataType: 'json',
        //             success: function(response){    
        //                 if(response.status == 'success')                            
        //                     $('#calendar55').fullCalendar('updateEvent',event);
        //             },
        //             error: function(e){
        //                 alert('Error processing your request: '+e.responseText);
        //             }
        //         });
        //   }
        window.location.href = "/events/" + event.id;
        },
        eventResize: function(event, delta, revertFunc) {
        console.log(event);
                var title = event.title;
                var end = event.end.format();
                var start = event.start.format();
                $.ajax({
                url: '/modify_entry',
                        data: 'type=resetdate&title=' + title + '&start=' + start + '&end=' + end + '&eventid=' + event.id + '&_token=' + Laravel.csrfToken,
                        type: 'POST',
                        dataType: 'json',
                        success: function(response){
                        if (response.status != 'success')
                                revertFunc();
                        },
                        error: function(e){
                        revertFunc();
                                alert('Error processing your request: ' + e.responseText);
                        }
                });
        },
        eventDragStop: function (event, jsEvent, ui, view) {
        // if (isElemOverDiv()) {
        //     var con = confirm('Are you sure to delete this event permanently?');
        //     if(con == true) {
        //         $.ajax({
        //             url: 'process.php',
        //             data: 'type=remove&eventid='+event.id,
        //             type: 'POST',
        //             dataType: 'json',
        //             success: function(response){
        //                 console.log(response);
        //                 if(response.status == 'success'){
        //                     $('#calendar55').fullCalendar('removeEvents');
        //                     getFreshEvents();
        //                 }
        //             },
        //             error: function(e){ 
        //                 alert('Error processing your request: '+e.responseText);
        //             }
        //         });
        //     }   
        // }
        },
        dayClick: function(date, jsEvent, view) {

        hours = date.format('HH');
                $("#start_date").datepicker('setDate', date.format('MM/DD/YYYY'));
                $("#end_date").datepicker('setDate', date.format('MM/DD/YYYY'));
                $("#myModal").modal();
        }
});
// $(".datepicker-inline").hide();
        function getFreshEvents(){
        $.ajax({
        url: 'process.php',
                type: 'POST', // Send post data
                data: 'type=fetch',
                async: false,
                success: function(s){
                freshevents = s;
                }
        });
                $('#calendar55').fullCalendar('addEventSource', JSON.parse(freshevents));
        }

function isElemOverDiv() {
var trashEl = jQuery('#trash');
        var ofs = trashEl.offset();
        var x1 = ofs.left;
        var x2 = ofs.left + trashEl.outerWidth(true);
        var y1 = ofs.top;
        var y2 = ofs.top + trashEl.outerHeight(true);
        if (currentMousePos.x >= x1 && currentMousePos.x <= x2 &&
                currentMousePos.y >= y1 && currentMousePos.y <= y2) {
return true;
        }
return false;
}
$('#myTable').show();
        $('#myTable').DataTable({ responsive: true});
        $('#start_date').datepicker();
        $('#end_date').datepicker();
        $(".js-data-example-ajax").select2({
ajax: {
url: '/universities/list',
        dataType: 'json',
        data: function (params) {
        return {
        term: params.term || '',
                page: params.page || 1
        }
        },
        cache: true
        }
});
        $("#coursesList").select2({
ajax: {
url: '/courses/coursesList',
        dataType: 'json',
        data: function (params) {
        return {
        term: params.term || '',
                page: params.page || 1
        }
        },
        cache: true
        }
});
        $("#privacySelector").change(function () {
var id = $("#privacySelector option:selected").val();
        if (id == 1)
        {

        $("#questionCateories").hide("slow");
                }
else
        {

        $("#questionCateories").show("slow");
                }
});
});
</script>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Create Event</h4>
            </div>
            <form id="eventPostForm" method="POST" action="/events" enctype="multipart/form-data"> 

                <div class="modal-body">
                    <div class="box box-solid">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input name="title" type="text" class="validate[required] form-control" placeholder="Event Title">
                            </div>
                            <div class="form-group">
                                <label>Cover</label>
                                <input name="cover" type="file" class="form-control" placeholder="Event Cover" accept="image/*" />
                            </div>
                            <div class="form-group">
                                <label>Start Date</label>
                                <input id="start_date" name="start_date" type="text" class="form-control" placeholder="Event Start">
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input id="st_timepicker" type="text" name="start_time" class="form-control input-small">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>End Date</label>
                                <input id="end_date" type="text" name="end_date" class="form-control" placeholder="Event End">
                                <div class="input-group bootstrap-timepicker timepicker">
                                    <input id="et_timepicker" type="text" name="end_time" class="form-control input-small">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" class="validate[required] form-control" placeholder="Event Description"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Attachments</label>
                                <input name="attachments" type="file" class="form-control" placeholder="Event Cover">
                            </div>
                            <div id="questionCateories" style="display: none" class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Country: </label><br>
                                    @include('pages.common.countries')    
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Universities: </label>
                                    <br>
                                    <select data-placeholder="Choose a universities..." name="universities[]" class="chosen-select form-control validate[groupRequired[categories]] js-data-example-ajax" multiple>
                                    </select>   
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Major: </label>
                                    <br>
                                    <select id="coursesList" data-placeholder="Choose a Major Courses..." name="courses[]" class="chosen-select form-control validate[groupRequired[categories]]" multiple>
                                    </select>    
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Event Setting: </label>
                                <select name="public" id="privacySelector" class="form-control">
                                    <option value="1">Public</option>
                                    <option value="0">Private</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>cost</label>
                                <input type="number" name="cost" class="form-control" placeholder="Event Cost" value="0">
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                            </div><!-- /input-group -->
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

jQuery(document).ready(function () {
        jQuery('#eventPostForm').validationEngine();
    });


</script>
@endsection