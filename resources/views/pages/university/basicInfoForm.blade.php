<form role="form" id='universityBasicInfoStore' method="POST" action="{{ url('/admin/universityInfoStore') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

        <input name="universityId" type="hidden" value="{{$universityId}}">
        <div class="col-lg-10">
            <div class="col-lg-5">
                <div class="box box-primary">
                    <div class="box-body box-profile" style="background:url(<?php echo $uni['cover']?>) ">
                        <img src="{{ $uni['profile'] }}" 
                             class="profile-user-img img-responsive img-circle" 
                             alt="User Image">
                        <h3 class="profile-username text-center">{{ $uni['name']  }}</h3>
                        <p class="text-muted text-center"></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="form-group">
                    <label for="exampleInputFile">Profile Photo</label>
                    <span class="btn default btn-file">

                        <span class="fileinput-new fa fa-file">
                            Select File </span>
                        <input name="profile" type="file" >
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input  value="{{$uni['name']}}"  type="text" name='name' class="form-control validate[required]"  placeholder="Enter Name">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Email</label>
        <input value="{{$uni['email']}}" type="text" name='email' class="form-control validate[required,custom[email]]"  placeholder="Enter Email">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Phone #: </label>
        <input value="{{$uni['phone']}}" type="text" name='phone' class="form-control validate[required]" id="post_title" placeholder="Enter Phone Number">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Address: </label>
        <input value="{{$uni['address']}}" type="text" name='address' class="form-control validate[required]" id="post_title" placeholder="Enter Address">
    </div>
    
    <div class="form-group">
        <label for="exampleInputEmail1">Tag Line: </label>
        <input value="{{$uni['tag_line']}}" type="text" name='tag_line' class="form-control validate[required]" id="post_title" placeholder="University Moto">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Website: </label>
        <input value="{{$uni['website']}}" type="text" name='website' class="form-control validate[required]" id="post_title" placeholder="Enter Website Link">
    </div>
    

    <div class="form-group">
        <label for="exampleInputEmail1">Mission Statement</label>
        <textarea  name='description1' placeholder="University mission statement" class="textarea validate[required]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$uni['description1']}}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Highlight and Facts</label>
        <textarea  name='description2' placeholder="University highlight and facts" class="textarea validate[required]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$uni['description2']}}</textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">History</label>
        <textarea  name='description3' placeholder="University history summary" class="textarea validate[required]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$uni['description3']}}</textarea>
    </div>


    <div class="box-footer">
        <button type="submit"  id='btn_posting' class="btn btn-primary">Submit</button>
    </div>

</form>
