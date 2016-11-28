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
                                <h3 class="box-title">Generate Notice</h3>
                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->
                            <form role="form" id='questionPostForm' method="POST" action="{{ url('/admin/notice/create') }}" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Title</label>
                                        <input type="text" name='title' class="form-control validate[required]" id="post_title" placeholder="Enter Title">
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="exampleInputFile">Add Media</label>
                                        <span class="btn default btn-file">

                                            <span class="fileinput-new fa fa-file">
                                                Select File </span>

                                            <input name="file" type="file" >
                                        </span>

                                        <p class="help-block">Add  powerpoint, image , audio file.</p>
                                    </div>
                                    <span class="help-block">
                                            <strong>
                                                <?php 
                                                if(!empty($image_error)){
                                                    ?>
                                                {{$image_error}}
                                                <?php 
                                                }
                                                ?>
                                            </strong>
                                    </span>
                                </div>
                                <!-- /.box-body -->



                        </div>
                        <!-- /.box -->


                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Write Description 
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

                                <textarea  name='description' placeholder="Place some text here" class="textarea validate[required]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>

                            </div>
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