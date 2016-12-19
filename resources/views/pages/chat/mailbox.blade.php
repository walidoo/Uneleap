@extends('layouts.master')
@section('content')

<section class="content">

    <div class="col-md-3">
        <div class="form-group">
            <label for="exampleInputPassword1">Composer: </label>
            <br>
            <select id="coursesList" data-placeholder="Select user to start Chat" name="courses[]" class="chosen-select form-control">
            </select>
        </div>
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Folders</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li id="inboxLi" class="active"><a href="{{ url('/user/messages') }}"><i class="fa fa-inbox"></i> Inbox
                            <span class="label label-primary pull-right">{{ count($inbox)}}</span></a></li>
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
    <div class="col-md-9">
        <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="mailbox-controls">
                    <button type="button" onClick="refresh()" class="btn btn-default btn-sm"><a class="fa fa-refresh"></a></button>
                    <!-- /.pull-right -->
                </div>
                <div class="table-responsive mailbox-messages">
                    <div class="box-header with-border">
                        <h3 class="box-title">Inbox</h3>
                        <!-- /.box-tools -->
                    </div>
                    <table class="table table-hover table-striped">
                        <tbody>
                            @foreach($inbox as $message)
                            <tr id="message-row-{{$message['id']}}">
                                <td>
                                    <div class="btn-group">
                                        <button onClick="deleteChat({{$message['id']}})" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </td>
                                <td class="mailbox-name"><a href="{{ url('/user/chat/'.$message['sender_id']) }}">{{$message['sender_name']}}</a></td>
                                <td class="mailbox-subject">{{$message['message']}}
                                </td>
                                <td class="mailbox-attachment"></td>
                                <td class="mailbox-date">{{$message['created_at']}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
</section>
<script>

            function deleteChat($id)
            {
            if (!confirm("Do you want to delete")) {
            return false;
            }
            else {
            data = {'id':$id};
                    var params = new Object();
                    params.data = data;
                    var callback_urgencyAdminJdReport = $.Callbacks();
                    callback_urgencyAdminJdReport.add(function takeAction(response)
                    {
                    if (response['status'] == 1)
                    {
                    location.reload();
                            // var class = '#message-row-' + response['id'];
                            //  alert(class);
                            //  $(class).remove();
                    }
                    });
                    var response = AjaxModule.postRequestReturnResponse('/user/messages/delete', 'POST', params, callback_urgencyAdminJdReport);
                    return false;
            }
            }
    function refresh()
    {
    location.reload('/user/messages');
    }
    $("#coursesList").select2({
    ajax: {
    url: '/user/getFolowers',
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
    $("#coursesList").change(function() {
            window.location.replace('/user/chat/' + $("#coursesList option:selected").val());
    });

</script>
@endsection