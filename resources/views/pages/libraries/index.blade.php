@extends('layouts.master')
@section('content')

<!-- PRODUCT LIST -->
<div class="box box-primary">
    <div class="box-header with-border">
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            <!-- /.item -->
            @include('pages.libraries.listBookTemplate')
            <!-- /.item -->
        </ul>
    </div>
    <!-- /.box-body -->
    <!-- /.box-footer -->
</div>
<div id="dialog-form" style="display:none;">
    <label>Comment: </label><input type="text" />
</div>
<!-- /.box -->

<script>

    $(document).ready(function () {
        var list = document.getElementsByClassName("myImage");
        for (var i = 0; i < list.length; i++) {
            var viewer = new Viewer(list[i], true);
        }
    });
</script>
@endsection