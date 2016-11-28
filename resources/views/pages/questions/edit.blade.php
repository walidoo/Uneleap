@extends('layouts.master')
@section('content')

<!-- Main content -->
<section class="content">

    <div class="row">
        <div class="col-md-9">
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <h3 class="box-title">Edit a question</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" id='questionPostForm' method="POST" action="{{ url('/question/edit') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name='questionId'  value="{{ \encrypt($question->id) }}">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" name='title'  value="{{ $question->title}}" class="form-control validate[required]" id="post_title" placeholder="Enter Title">
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputFile">Add Media</label>
                                        <span class="btn default btn-file">

                                            <span class="fileinput-new fa fa-file">
                                                Select File </span>

                                            <input name="file" type="file" >
                                        </span>

                                        <p class="help-block">Add  powerpoint, image , audio file.</p>
                                        <p class="help-block">Old File: <a target="_blank" href="{{$question->path}}">{{$question->filename}}</a></p>

                                    </div>
                                    <span class="help-block">
                                        <strong>
                                            <?php
                                            if (!empty($image_error)) {
                                                ?>
                                                {{$image_error}}
                                                <?php
                                            }
                                            ?>
                                        </strong>
                                    </span>



                                    <div class="box">
                                        <div class="box-header">
                                            <h3 class="box-title">Write Question 
                                                <small></small>
                                            </h3>
                                            <!-- tools box -->
                                            <div class="pull-right box-tools">
                                                <button type="button" class="btn btn-default btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                                                    <i class="fa fa-minus"></i></button>
                                                <button type="button" class="btn btn-default btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                                                    <i class="fa fa-times"></i></button>
                                            </div>
                                            <!-- /. tools -->
                                        </div>
                                        <!-- /.box-header -->
                                        <div class="box-body pad">

                                            <textarea  name='description' placeholder="{{$question->description}}" class="textarea validate[required]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Privacy</label>
                                    <select data-placeholder="Choose a Privacy..." name="privacy" class="form-control validate[required]">
                                        <option <?php if ($question->privacy == 0) { ?>  selected <?php } ?> value="0">Public</option>
                                        <option <?php if ($question->privacy == 1) { ?>  selected <?php } ?> value="1">Private</option>
                                    </select>
                                </div>

                                <div class="box-footer">
                                    <button type="submit"  id='btn_posting' class="btn btn-primary">Write Question</button>
                                </div>
                                <!-- /.col-->
                        </div>
                        </form>
                    </div>
                    <!-- /.box-body -->



                </div>
                <!-- /.box -->
                <!-- ./row -->
            </section>
            <!-- /.content -->
        </div>
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

</section>   
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#questionPostForm').validationEngine();
    });
</script>
@endsection