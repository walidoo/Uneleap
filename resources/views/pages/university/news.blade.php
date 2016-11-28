<div class="tab-pane active" id="timeline">
    <!-- The timeline -->
    <ul class="timeline timeline-inverse">


        @foreach( $news as $new )    
            <li class="time-label">
                <span class="bg-red">
                    {{ $new->created_at->toFormattedDateString()}}
                </span>
            </li>
            <li>
                <i class="fa fa-clock-o bg-gray"></i>

                <div class="timeline-item">
                    <span class="time"><i class="fa fa-clock-o"></i> {{ $new->created_at->toTimeString()}}</span>

                    <h3 class="timeline-header"><a href="#"></a> {{$new->title}}</h3>

                    <div class="timeline-body">
                        {{$new->description}}
                    </div>
                    <div class="timeline-footer">
                        <?php echo $new['attachment']; ?>
                    </div>
                </div>
            </li>
        @endforeach
        <div class="universityNewsPaginator timeline-footer pull-right">
            {{ $news->links() }}
        </div>
    </ul>
</div>