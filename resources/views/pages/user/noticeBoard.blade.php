@extends('layouts.master')
@section('content')

<section class="content-header">
    <h1>
        Uneleap's Notice Board
    </h1>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->


        <div class="active tab-pane" id="activity">
            <div class="active tab-pane" id="activity">

            </div>
            <!-- /.tab-pane -->
            <div class="tab-pane" id="timeline">
                <!-- The timeline -->
                <ul class="timeline timeline-inverse">
                    @foreach( $notifications as $notification)

                    <li class="time-label">
                        <span class="bg-red">
                            {{ $notification->created_at->toFormattedDateString()}}
                        </span>
                    </li>
                    <li>
                        <i class="fa fa-envelope bg-blue"></i>

                        <div class="timeline-item">
                            <span class="time"><i class="fa fa-clock-o"></i> {{ $notification->created_at->toTimeString()}}</span>
                            @if( $user->id == $notification->user_id )
                            <button onClick="deleteNotice('{{\encrypt( $notification->id )}}');" type="button" class="btn btn-box-tool"  data-toggle="tooltip" title="Delete">
                                <i class="fa fa-times"></i>
                            </button>
                            @endif
                            <h3 class="timeline-header"> <a >Admin: </a> <b> {{$notification->title}} </b>  </h3>

                            <div class="timeline-body">

                                <?php echo nl2br($notification->description); ?>
                            </div>

                            <div class="timeline-footer">
                                <?php echo $notification['attachment']; ?>
                            </div>
                        </div>
                    </li>
                    @endforeach
                    {{ $notifications->links() }}
                </ul>
            </div>
    </section>




    @endsection