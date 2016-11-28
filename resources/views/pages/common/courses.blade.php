<select data-placeholder="Choose a Major Courses..." name="courses[]" class="chosen-select-courses form-control validate[required]" multiple  tabindex="4">
    <option value=""></option>
    <option value="United States">United States</option>
    <option value="United Kingdom">United Kingdom</option>
    <option value="Afghanistan">Afghanistan</option>
    <option value="Aland Islands">Aland Islands</option>
    <option value="Albania">Albania</option>
    <option value="Algeria">Algeria</option>
    <option value="American Samoa">American Samoa</option>
    <option value="Andorra">Andorra</option>
    <option value="Angola">Angola</option>

</select>
<script type="text/javascript">
    /*$(".chosen-select-courses").chosen();*/
    $('.chosen-select-courses').select2({
        tags: true
    })
</script>