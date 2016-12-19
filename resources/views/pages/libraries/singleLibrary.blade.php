@extends('layouts.master')
@section('content')
<!-- PRODUCT LIST -->
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Library</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Minimize">
                <i class="fa fa-minus"></i>
            </button>
            @if( $user->id == $library->user_id )
            <button onClick="editLibrary('{{ \encrypt(  $library->id ) }}')" type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Edit">
                <i class="fa fa-edit"></i>
            </button>
            <button onClick="deleteLibrary('{{\encrypt( $library->id )}}');" type="button" class="btn btn-box-tool"  data-toggle="tooltip" title="Delete">
                <i class="fa fa-times"></i>
            </button>
            @endif
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            <li class="item">
                <div class="product-img">
                    <img src="{{ URL::asset('public/'.$library->cover) }}" alt="Product Image">
                </div>
                <div class="product-info">
                    <label> Author: &emsp;    
                        <a href="/user/profile/{{$library->user_id}}" class="product-title"> {{$library->author}}</a>
                    </label>
                    <br>
                    <label> Title: &emsp;    
                        <span  class="product-title"> {{$library->title}}</span>
                    </label>
                    <span class="product-description">
                        <?php echo strip_tags($library->description); ?>
                    </span>

                    <br>
                    <?php echo $library['attachment']; ?>
                    <br>
                    <span class="product-description">
                        @if(!empty($library['tags']))
                        @foreach($library['tags'] as $tag )
                        <span class="label label-success"> {{ $tag->filter }}</span>
                        @endforeach
                        @endif
                    </span>
                    <br>
                    @include('pages.libraries.libraryComments')
                </div>
            </li>
        </ul>
    </div>
    <!-- /.box-body -->
    <!-- /.box-footer -->
</div>
<div id="dialog-form" style="display:none;">
    <label>Comment: </label><input type="text" />
</div>
<!-- /.box -->
@endsection