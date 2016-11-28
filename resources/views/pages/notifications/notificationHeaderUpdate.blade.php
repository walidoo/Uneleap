@foreach( $notifications as $notification)
<li>
    <a href="{{ $notification['href'] }}">
        <i class="fa fa-users text-aqua"></i> {{$notification->title}}
        <span class="text-muted pull-right">{{$notification->created_at->diffForHumans()}}</span>
    </a>
</li>

@endforeach