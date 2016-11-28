<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-envelope-o"></i>
        <span class="label label-success"> <span class="messagesHeaderCounter"> {{count($messages)}}</span> </span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have <span class="messagesHeaderCounter">{{count($messages)}}</span> messages</li>
        <li>
            <ul class="menu">
                <li id="messagesHeader">

                    @foreach($messages as $message )
                    <a href="/user/chat/{{$message['sender_id']}}">
                        <div class="pull-left">
                            <img src="{{$message['sender_pic']}}" class="img-circle" alt="User Image">
                        </div>
                        <h4>
                            <small><i class="fa fa-clock-o"></i> {{$message['created_at']}}</small>
                        </h4>
                        <p>{{ substr($message['message'],0,2)}}</p>
                    </a>
                    @endforeach
                </li>

            </ul>
        </li>
        <li class="footer"><a href="/user/messages">See All Messages</a></li>
    </ul>
</li>