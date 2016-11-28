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
                    <h3 class="box-title">Pending Requests</h3>
                </div>
                <ul class="products-list product-list-in-box">
                    @foreach( $followers as  $follower ) 
                    <li class="item">
                        <div class="product-img">
                            <img src="{{$follower['follower']->profile_picture_path}}" alt="Product Image">
                        </div>
                        <div class="product-info">
                            <label> Name: &emsp;    
                                <a href="/user/profile/{{$follower['follower']->id}}" class="product-title"> {{$follower['follower']->name}}</a>
                            </label>
                            <br>
                            <label> Country: &emsp;    
                                <span  class="product-title">{{$follower['follower']->country}}</span>
                            </label>
                            <span class="product-description">
                                {{$follower->created_at->diffForHumans()}}
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