<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-bell-o"></i>
        <span class="label label-warning" > <span class="notificationHeaderCounter"> {{$unReadNotificationsCount}} </span></span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have  <span class="notificationHeaderCounter"> {{$unReadNotificationsCount}}</span> notifications</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu" id="notificationHeader">
                @foreach( $notifications as $notification)
                <li>
                    <a href="{{ $notification['href'] }}">
                        <i class="fa fa-users text-aqua"></i> {{$notification->title}}
                        <span class="text-muted pull-right">{{$notification->created_at->diffForHumans()}}</span>
                    </a>
                </li>

                @endforeach
            </ul>
        </li>
        <li class="footer"><a href="/user/notifications">View all</a></li>
    </ul>
</li>