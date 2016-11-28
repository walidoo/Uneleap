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
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Settings</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" id='questionPostForm' method="POST" action="{{ url('/user/setting') }}" >
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name='name' class="form-control validate[required]" id="post_title" value="{{ $user->name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Name</label>
                            <input type="text" name='user_name' placeholder="User Name" class="form-control" id="post_title" value="{{ $user->user_name}}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="text" name='email' class="form-control validate[required,custom[email]]" id="post_title" value="{{ $user->email}}">
                            <span class="help-block">
                                <strong>
                                    <?php
                                    if (!empty($email_error)) {
                                        ?>
                                        {{$email_error}}
                                        <?php
                                    }
                                    ?>
                                </strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Old Password</label>
                            <input type="password" name='old_password' class="form-control validate[condRequired[new_password],minSize[6]]" id="post_title" Placeholder="Old Password">
                            <span class="help-block">
                                <strong style="color:red;">
                                    <?php
                                    if (!empty($password_error)) {
                                        ?>
                                        {{$password_error}}
                                        <?php
                                    }
                                    ?>
                                </strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">New Password</label>
                            <input type="password" name='new_password' class="form-control validate[minSize[6]]" id="new_password" Placeholder="Old Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Confirm New Password</label>
                            <input type="password" name='re_new_password' class="form-control validate[equals[new_password]]" id="post_title" Placeholder="Confirm New Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Country</label>
                            @include('pages.common.countriesSettings')
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">University</label>
                            <select data-placeholder="Choose a university..." name="university" class="chosen-select form-control validate[required] js-data-example-ajax">
                                @if(!empty($user->university))
                                <option value="0">{{ $user->university}} </option>
                                @endif
                            </select> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Language</label>
                            @include('pages.common.languagesWithOutRequire') 
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value=0></option>
                                <option value=2>Suspend</option>
                                <option value=3>Deactivate</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Privacy</label>
                            <select name="privacy" class="form-control">
                                <option value=0></option>
                                <option value=1 <?php  if($user->privacy==1){ ?>  selected <?php }?> >Public</option>
                                <option value=2 <?php  if($user->privacy==2){ ?>  selected <?php }?> >Private</option>
                            </select>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit"  id='btn_posting' class="btn btn-primary">save settings</button>
                    </div>
                </form>

            </div>
            <!-- /.box -->
        </div>

        <!-- /.col-->
    </div>

    <!-- ./row -->
</section>

<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('#questionPostForm').validationEngine();
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
</script>

@endsection