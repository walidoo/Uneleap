<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">University Members</h3>

        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <ul class="products-list product-list-in-box">
            @foreach( $users as $user)
            <li class="item">
                <div class="product-img">
                    <img src="{{$user->profile_picture_path}}" alt="Product Image">
                </div>
                <div class="product-info">
                    <a href="/user/profile/{{$user->id}}" class="product-title">{{$user->user_name}}
                    </a>
                    <span class="product-description">
                        {{ $user->profile_summary}}
                    </span>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <!-- /.box-body -->
    <div class="box-footer text-center">
        {{ $users->links() }}
    </div>
    <!-- /.box-footer -->
</div>