<select data-placeholder="Choose a Tag..." name="tags[]" class="chosen-select-courses form-control validate[required]" multiple  tabindex="4">

</select>
<script type="text/javascript">
    /*$(".chosen-select-courses").chosen();*/
    $('.chosen-select-courses').select2({
        tags: true
    })
</script>