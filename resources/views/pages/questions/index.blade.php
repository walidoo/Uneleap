@extends('layouts.master')
@section('content')

<div class="row">
    @if(count($questions)>0)
    @foreach( $questions as $question)
    @if($question['isValidToDisplay'] == 1)
    @include('pages.questions.listQuestionTemplate')
    @endif
    @endforeach
    @else
    <div class="col-md-10">
        <!-- Box Comment -->
        <div class="box box-widget">
            <div class="box-header with-border">
                No Question Found
            </div>
        </div>
    </div>
    @endif
</div>
<!-- /.row -->

<script>

    $(document).ready(function () {
        var list = document.getElementsByClassName("myImage");
        for (var i = 0; i < list.length; i++) {
            var viewer = new Viewer(list[i], true);
        }
    });
</script>
{{ $questions->links() }}
@endsection