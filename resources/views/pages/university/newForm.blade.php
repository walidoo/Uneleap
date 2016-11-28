<form role="form" id='universityNewsStore' method="POST" action="{{ url('/admin/universityNewsStore') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="box-body">

        <input name="universityId" type="hidden" value="{{$universityId}}">

    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Name</label>
        <input    type="text" name='title' class="form-control validate[required]"  placeholder="Enter Title">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Description</label>
        <textarea  name='description' placeholder="Place some text here" class="textarea validate[required]" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
    </div>
    <div class="form-group">
        <label for="exampleInputFile">Attachment</label>
        <span class="btn default btn-file">

            <span class="fileinput-new fa fa-file">
                Select File </span>
            <input name="attachment" type="file" >
        </span>
    </div>
    <div class="box-footer">
        <button type="submit"  id='btn_posting' class="btn btn-primary">Submit</button>
    </div>

</form>
