@extends('layouts.master')
@section('content')
<section class="content">

    <!-- Default box -->        
    <div class="box box-primary">
        <!-- DIRECT CHAT PRIMARY -->
        <div class="box box-primary direct-chat direct-chat-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Direct Chat</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Conversations are loaded here -->
                <div id="messageId" class="direct-chat-messages" style="height: 450px;">
                    <!-- Message to the right -->
                    @foreach( $chats as $chat )
                    <div class="direct-chat-msg {{$chat['cssRight']}}">
                        <div class="direct-chat-info clearfix">
                            <span class="direct-chat-name {{$chat['cssPull']}}">{{ $chat['name'] }}</span>
                            <span class="direct-chat-timestamp {{$chat['cssTimePull']}}">{{$chat->created_at->diffForHumans()}}</span>
                        </div>
                        <!-- /.direct-chat-info -->
                        <a href="{{$chat['profile_link']}}">
                            <img class="direct-chat-img" src="{{ $chat['profile_picture_path'] }}" alt="Message User Image"><!-- /.direct-chat-img -->
                        </a>
                        <div class="direct-chat-text">
                            {{ $chat->message }}
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    @endforeach
                    <!-- /.direct-chat-msg -->
                </div>
                <!--/.direct-chat-messages-->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <form  method="POST" action="/user/chat/send" >
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="hidden" name="receiver_id" value="{{ $guest->id }}">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary btn-flat">Send</button>
                        </span>
                    </div>
                </form>
            </div>
            <!-- /.box-footer-->
        </div>
        <!--/.direct-chat -->
    </div>
</section>
<script>
    $("#messageId").scrollTop($("#messageId")[0].scrollHeight);
</script>
@endsection