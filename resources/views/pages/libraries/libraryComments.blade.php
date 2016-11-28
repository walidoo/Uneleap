<div class="box-footer box-comments">
    @if(!empty( $library['comments'] ))
    @foreach( $library['comments'] as $comment)
    <div class="box-comment" id="libraryComment-{{$comment->id}}">
        <!-- User image -->
        <img class="img-circle img-sm" src="{{ $comment['user']->profile_picture_path }}" alt="User Image">

        <div class="comment-text">
            <span class="username">
                <a href="/user/profile/{{$comment['user']->id}}"> {{ $comment['user']->name }} </a>
                <span class="text-muted pull-right">{{$comment->created_at->diffForHumans()}}</span>
            </span><!-- /.username -->
             <span id="libraryCommentTile-{{$comment->id}}" > {{ $comment->comment}} </span>
            @if( $user->id == $comment['user']->id )
                <button  onClick="deleteLibraryComment('{{ \encrypt($comment->id) }}')" type="button" class="btn btn-box-tool pull-right"  data-toggle="tooltip" title="Delete">
                    <i class="fa  fa-scissors"></i>
                </button>
                <button  onClick="editLibraryComment('{{ \encrypt( $comment->id ) }}','{{ $comment->comment }}');" type="button" class="btn btn-box-tool pull-right" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-edit"></i>
                </button>
            @endif
        </div>
        <!-- /.comment-text -->
    </div>
    @endforeach
    @endif
    <!-- /.box-comment -->
</div>

<!-- /.box-footer -->
<div class="box-footer">
    <form method="POST" action="{{ url('/library/comment/store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="library_id" value="{{$library->id}}">
        <img class="img-responsive img-circle img-sm" src="{{$user->profile_picture_path}}" alt="Alt Text">
        <div class="img-push">
            <input type="text" id="commentBox" name="comment" class="form-control input-sm" placeholder="Press enter to post comment">
        </div>
    </form>
</div>
<!-- /.box-footer -->