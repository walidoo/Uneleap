@extends('layouts.master')
@section('content')
<section class="content-header">
    <ol class="breadcrumb">
        <li><a ><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"><a >Followers</a></li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <div class="row">

        <div class="col-md-9">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Following</h3>
                </div>
                <ul class="products-list product-list-in-box">
                    @foreach( $followings as  $following ) 
                    <li class="item">
                        <div class="product-img">
                            <img src="{{$following['following']->profile_picture_path}}" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <label> Name: &emsp;    
                                <a href="/user/profile/{{$following['following']->id}}" class="product-title"> {{$following['following']->name}}</a>
                            </label>
                            <br>
                            <label> Country: &emsp;    
                                <span  class="product-title">{{$following['following']->country}}</span>
                            </label>
                            <span class="product-description">
                                {{$following->created_at->diffForHumans()}}
                            </span>

                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>

            <!-- /.content -->
        </div>
    </div>
    <!-- /.col -->
    <!-- /.row -->

</section>   
@endsection