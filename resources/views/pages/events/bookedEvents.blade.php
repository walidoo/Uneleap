@extends('layouts.master')
@section('content')
<section class="content">
    <div class="row">

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

        @if(count($events)>0)
        <div class="col-md-12">
            <ul class="timeline">
                <?php $current_date = false ?>
                @foreach ($events as $booking)

                <?php $value = $booking['event']; ?>
                @if ($current_date != date('d/m/y',strtotime($value->start_date)) )
                <li class="time-label">
                    <span class="bg-red">
                        {{date('l jS \of F Y',strtotime($value->start_date))}}
                    </span>
                </li>
                @endif
                <li>
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
                @endforeach
                {{ $events->links() }}

            </ul>
        </div>
        @else 
        <div class="col-md-12" style="margin-bottom: 10px;">
            <div class="alert alert-danger">
                <ul>
                    <li>No Event Found</li>
                </ul>
            </div>
        </div>
        @endif
    </div>
</section><!-- /.content -->
@endsection