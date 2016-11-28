<div class="box-footer box-comments">
    @if(!empty( $question['comments'] ))
    @foreach( $question['comments'] as $comment)
    <div class="box-comment" id="questionComment-{{$comment->id}}">
        <!-- User image -->
        <img class="img-circle img-sm" src="{{ $comment['user']->profile_picture_path }}" alt="User Image">

        <div class="comment-text">
            <span class="username">
                <a href="/user/profile/{{$comment['user']->id}}"> {{ $comment['user']->name }} </a>
                <span class="text-muted pull-right">{{$comment->created_at->diffForHumans()}}</span>
            </span><!-- /.username -->
            
            <span id="questionCommentTile-{{$comment->id}}" > {{ $comment->comment}} </span>
            @if( $user->id == $comment['user']->id )
                <button  onClick="deleteComment('{{ \encrypt($comment->id) }}')" type="button" class="btn btn-box-tool pull-right"  data-toggle="tooltip" title="Delete">
                    <i class="fa  fa-scissors"></i>
                </button>
                <button  onClick="editComment('{{ \encrypt( $comment->id ) }}','{{ $comment->comment }}');" type="button" class="btn btn-box-tool pull-right" data-toggle="tooltip" title="Edit">
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
    <form method="POST" action="{{ url('/question/comment/store') }}">
        {{ csrf_field() }}
        <input type="hidden" name="question_id" value="{{$question->id}}">
        <img class="img-responsive img-circle img-sm" src="{{$user->profile_picture_path}}" alt="Alt Text">
        <div class="img-push">
            <input type="text" id="commentBox" name="comment" class="form-control input-sm" placeholder="Press enter to post comment">
        </div>
    </form>
</div>
<!-- /.box-footer -->

<script type="text/javascript">

</script>