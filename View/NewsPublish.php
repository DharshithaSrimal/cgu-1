<?php

?>
<!-- include libraries(jQuery, bootstrap) -->

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.css" rel="stylesheet">

<div id="composeNews"></div>

<script>
    $('#composeNews').summernote({
        placeholder: 'Type your message',
        tabsize: 2,
        height: 370
    });
</script>

<div style="display: inline-flex" >
    <input class="btn btn-info" id="publishNews" type="button" value="Publish">
    <select class="form-control col-md-8" id="publishScope" style="margin-left: 20px">
        <option id="1" value="1">for all</option>
        <option id="0" value="0">for my students</option>
    </select>
</div>

<script>
    $("#publishNews").click(function () {
        publishNews();
    });

    function publishNews(){

        var content=  $('#composeNews').summernote('code');
        content =  content.replace(/\+/g,'%2B');
        var method = "publishNews";

        var publishScope = $('#publishScope').val();

        $.ajax({
            type: "POST",
            url: "../Controller/NewsPublishController.php",
            data: 'content='+content+'&method='+method+'&publishScope='+publishScope,
            cache: false,
            success: function(result){
                console.log("aa "+result);
                alert( "Published !");
                $('#composeNews').summernote('code', '');
            }
        });

    }
</script>