@extends('layouts.master')
@section('content')

<div class="row">
    <div class="col-md-10">
        <!-- Box Comment -->
        <div class="box box-widget">
            <div class="box-header with-border">
                <div class="user-block">
                    <img class="img-circle" src="{{ $question['user']->profile_picture_path }}" alt="User Image">
                    <span class="username"><a href="/user/profile/{{$question['user']->id}}">{{ $question['user']->name }}</a></span>
                    <span class="description">{{ $question->created_at->diffForHumans() }}</span>
                </div>
                <!-- /.user-block -->
                <div class="box-tools">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimize">
                    <i class="fa fa-minus"></i>
                </button>
                @if( $user->id == $question['user']->id )
                <button onClick="editQuestion('{{ \encrypt(  $question->id ) }}')" type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-edit"></i>
                </button>
                <button onClick="deleteQuestion('{{\encrypt( $question->id )}}');" type="button" class="btn btn-box-tool"  data-toggle="tooltip" title="Delete">
                    <i class="fa fa-times"></i>
                </button>
                @endif
            </div>
                <!-- /.box-tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div> <h3>{{ $question->title }}</h3> </div>

                <!-- post text -->
                <p> <b>Description:</b> <?php echo nl2br($question->description); ?></p>

                @if( !empty($question['attachment']))
                    <!-- Attachment -->
                    <?php echo $question['attachment']; ?>
                    <br>
                @endif
                <!-- /.attachment-block -->
                <!-- Social sharing buttons -->
                <form method="POST" action="{{ url('/question/like/store') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="question_id" value="{{$question->id}}">  
                    <!--button type="button" class="btn btn-default btn-xs"><i class="fa fa-share"></i> Share</button!-->
                    @if($question['like'] == 0)    
                         <button type="submit" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up"></i> Like</button>
                    @endif
                </form>
                <span class="pull-right text-muted">{{count($question['likes'])}} likes - {{count($question['comments'])}} comments</span>
            @if(!empty($question['tags']))
                @foreach($question['tags'] as $tag )
                    <span class="label label-success"> {{ $tag->filter }}</span>
                @endforeach
            @endif
            <br>
            </div>
            <!-- /.box-body -->
            @include('pages.questions.questionComments')
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<div id="dialog-form" style="display:none;">
    <label>Comment: </label><input type="text" />
</div>
<!-- /.row -->
@endsection