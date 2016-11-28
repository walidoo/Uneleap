<select data-placeholder="Choose a Languages..." name="language" class="chosen-select-languages form-control"  tabindex="4">
    @if(!empty($user->language))
    <option value="0"> {{$user->language}} </option>
    @endif
</select>
<script type="text/javascript">
    /*$(".chosen-select-courses").chosen();*/
    $('.chosen-select-languages').select2({
        tags: true
    })
</script>