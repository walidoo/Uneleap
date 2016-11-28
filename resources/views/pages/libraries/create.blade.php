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
                <form role="form" id='libraryPostForm' method="POST" action="{{ url('/libraries/create') }}" enctype="multipart/form-data">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Add To Library</h3>
                                </div>
                                <!-- /.box-header -->
                                <!-- form start -->
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input  value="{{ old('title') }}" type="text" name='title' class="form-control validate[required]" id="post_title" placeholder="Enter Title">
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputFile">Cover Photo</label>
                                        <span class="btn default btn-file">

                                            <span class="fileinput-new fa fa-file">
                                                Select File </span>
                                            <input name="cover" type="file" >
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Tag</label>
                                        @include('pages.common.tags') 
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Attachment</label>
                                        <span class="btn default btn-file">

                                            <span class="fileinput-new fa fa-file">
                                                Select File </span>

                                            <input name="attachment" type="file" >
                                        </span>

                                        <p class="help-block">Add  powerpoint, image , audio file.</p>
                                        <span class="help-block">
                                            <strong stle="color: red;">
                                                <?php
                                                if (!empty($image_error)) {
                                                    ?>
                                                    {{$image_error}}
                                                    <?php
                                                }
                                                ?>
                                            </strong>
                                        </span>
                                    </div>

                                </div>
                                <!-- /.box-body -->
                            </div>
                            <!-- /.box -->
                            <div class="box">
                                <div class="box-header">
                                    <h3 class="box-title">Description
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
                                    <textarea  name='description' placeholder="Place some text here" class="textarea validate[required]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{ old('description') }}</textarea>
                                </div>                
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Author</label>
                                <input  value="{{ old('author') }}" type="text" class="form-control validate[required]" id="post_link" name="author"  placeholder="Author">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Languages</label>
                                @include('pages.common.languages') 
                            </div>
                            <div id="questionCateories" style="display: none" class="form-group">
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Country: </label><br>
                                    @include('pages.common.countries')    
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Universities: </label>
                                    <br>
                                    <select data-placeholder="Choose a universities..." name="universities[]" class="chosen-select form-control validate[groupRequired[categories]] js-data-example-ajax" multiple>
                                    </select>   
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputPassword1">Major: </label>
                                    <br>
                                    <select id="coursesList" data-placeholder="Choose a Major Courses..." name="courses[]" class="chosen-select form-control validate[groupRequired[categories]]" multiple>
                                    </select>    
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Privacy</label>
                                <select id="privacySelector" data-placeholder="Choose a Privacy..." name="privacy" class="form-control validate[required]">
                                    <option value="0">Public</option>
                                    <option value="1">Private</option>
                                </select>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit"  id='btn_posting' class="btn btn-primary">Submit</button>
                        </div>
                        <!-- /.col-->
                    </div>
                </form>
                <!-- ./row -->
            </section>
            <!-- /.content -->
        </div>
    </div>
</section>   
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#libraryPostForm').validationEngine();
    });

    $(".js-data-example-ajax").select2({
        ajax: {
            url: '/universities/list',
            dataType: 'json',
            data: function (params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        }
    });
    $("#coursesList").select2({
        ajax: {
            url: '/courses/coursesList',
            dataType: 'json',
            data: function (params) {
                return {
                    term: params.term || '',
                    page: params.page || 1
                }
            },
            cache: true
        }
    });
    $("#privacySelector").change(function () {
        var id = $("#privacySelector option:selected").val();
        if (id == 0)
        {

            $("#questionCateories").hide("slow");
        }
        else
        {

            $("#questionCateories").show("slow");
        }
    });
</script>

@endsection