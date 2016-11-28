@foreach($messages as $message )
<a href="/user/chat/{{$message['sender_id']}}">
    <div class="pull-left">
        <img src="{{$message['sender_pic']}}" class="img-circle" alt="User Image">
    </div>
    <h4>
        <small><i class="fa fa-clock-o"></i> {{$message['created_at']}}</small>
    </h4>
    <p>{{ substr($message['message'],0,22)}}</p>
</a>
@endforeach