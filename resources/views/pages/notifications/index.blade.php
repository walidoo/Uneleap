@extends('layouts.master')
@section('content')

<section class="content">
    <div class="col-md-12">
        <div class="box box-primary">
            <!-- /.box-header -->
            <div class="box-body no-padding">
                <div class="mailbox-controls">
                    <button type="button" class="btn btn-default btn-sm"><a href="{{ url('/user/notifications') }}" class="fa fa-refresh"></a></button>
                    <!-- /.pull-right -->
                </div>
                <div class="alert alert-success delete_notify" style="display: none;">
                    <p></p>
                </div>
                <div class="table-responsive mailbox-messages">
                    <div class="box-header with-border">
                        <h3 class="box-title">Notifications</h3>
                        <!-- /.box-tools -->
                    </div>
                    <table class="table table-hover table-striped">
                        <tbody>
                            @foreach($notifications as $notification)
                            <tr id="message-row">
                                <td>
                                    <div class="btn-group">
                                        <button onClick="deleteNotification({{$notification->id}})" type="button" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                                    </div>
                                </td>
                                <td class="mailbox-name"><a href="{{ url($notification['href']) }}">{{$notification->title}}</a></td>
                                
                                <td class="mailbox-attachment"></td>
                                <td class="mailbox-date">{{$notification->created_at->diffForHumans()}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $notifications->links() }}
                    <!-- /.table -->
                </div>
                <!-- /.mail-box-messages -->
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
</section>
@endsection