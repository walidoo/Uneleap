@extends('layouts.master')
@section('content')

<section class="content">

    <!-- Default box -->
    <div class="box">

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
                <div class="well well-sm">
                    <form id="feedback" class="form-horizontal" method="post" action="/user/feedback" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <fieldset>
                            <legend class="text-center header">Feedback Form</legend>



                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                                <div class="col-md-8">
                                    <textarea class="form-control validate[required]" id="message" name="description" placeholder="What do you like most about the application" rows="7"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i class="fa fa-pencil-square-o bigicon"></i></span>
                                <div class="col-md-8">
                                    <textarea class="form-control validate[required]" id="message" name="suggestion" placeholder="Please give your suggestions or issues to help us improve the application" rows="7"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i > </i></span>
                                <div class="col-md-8">
                                    How satisfied are you 
                                    <select  placeholder="How satisfied are you " name="rating" class="form-control validate[required]">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <span class="col-md-1 col-md-offset-2 text-center"><i > </i></span>
                                <div class="col-md-8">
                                    <label for="exampleInputFile">Attachment</label>
                                    <span class="btn default btn-file">

                                        <span class="fileinput-new fa fa-file">
                                            Select File </span>
                                        <input name="attachment" type="file" >
                                    </span>
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
                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#feedback').validationEngine();
    });
</script>
@endsection