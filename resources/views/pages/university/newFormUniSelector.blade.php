@extends('layouts.master')
@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a>University</a></li>
        <li class="active">News</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

        <div class="col-md-10">
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
                            <div class="box-header with-border">
                                <h3 class="box-title">University Info:</h3>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Universities: </label>
                                <br>
                                <select data-placeholder="Choose a universities..." name="university" class="chosen-select form-control validate[required] js-data-example-ajax">
                                </select>   
                            </div>
                            <div  id="universityNewsPageContent" style="width: 80%;
                                  margin-left: 10%;">


                            </div>
                            <!-- /.box-header -->
                            <!-- form start -->

                            <!-- ./row -->
                        </div>
                    </div>
                </div>
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
    $(".js-data-example-ajax").change(function () {
        data = {'id': $(".js-data-example-ajax option:selected").val()};
        var params = new Object();
        params.data = data;
        var callback_urgencyAdminJdReport = $.Callbacks();
        callback_urgencyAdminJdReport.add(function takeAction(response)
        {
            if (response['status'] == 1)
            {
                $("#universityNewsPageContent").html(response['data']);
                jQuery('#universityNewsStore').validationEngine();
            }
        });
        var response = AjaxModule.postRequestReturnResponse('/admin/university/newsForm', 'POST', params, callback_urgencyAdminJdReport);
        return false;
    });
</script>

@endsection