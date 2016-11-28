@if(count($dashboard)>0)
    @foreach( $dashboard as $data)
        @if(!empty($data['item']))
        <div id="question-{{$data['item']->id}}">
            <!-- Box Comment -->
            <div class="box box-widget">
                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="{{ $data['item']['user']->profile_picture_path }}" alt="User Image">
                        <span class="username"><a href="/user/profile/{{$data['item']['user']->id}}">{{ $data['item']['user']->name }}</a></span>
                        <span class="description"> {{$data['type']}} - {{ $data['item']->created_at->diffForHumans() }}</span>
                    </div>
                    <!-- /.user-block -->
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimize">
                            <i class="fa fa-minus"></i>
                        </button>
                            @if( $user->id == $data['item']->user_id )
                            <button onClick="editLibrary('{{ \encrypt(  $data['item']->id ) }}')" type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Edit">
                                <i class="fa fa-edit"></i>
                            </button>
                            <button onClick="deleteLibrary('{{\encrypt( $data['item']->id )}}');" type="button" class="btn btn-box-tool"  data-toggle="tooltip" title="Delete">
                                <i class="fa fa-times"></i>
                            </button>
                            @endif
                    </div>
                    <!-- /.box-tools -->
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div> <h3> <a href="{{  $data['href']  }}" >{{ $data['item']->title }} </a></h3> </div>

                    <!-- post text -->
                    <p> <b>Description:</b> <?php echo nl2br($data['item']->description); ?></p>

                    <!-- Attachment -->
                    <?php echo $data['item']['attachment']; ?>
                    <br>
                    <span class="description"> <a href="{{  $data['href']  }}">View Details </a></span>
                </div>

            </div>

            <!-- /.box -->
        </div>
        <!-- /.col -->
        @endif
    @endforeach
    <div class="libraryPaginator">
        {{ $dashboard->links() }}
    </div>
@else
No Data Found
@endif