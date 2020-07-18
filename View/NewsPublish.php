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

<input class="btn btn-info" id="publishNews" type="button" value="Publish">

<script>
    $("#publishNews").click(function () {
        publishNews();
    });

    function publishNews(){

        var content=  $('#composeNews').summernote('code');
        content =  content.replace(/\+/g,'%2B');
        var method = "publishNews";

        $.ajax({
            type: "POST",
            url: "../Controller/NewsPublishController.php",
            data: 'content='+content+'&method='+method,
            cache: false,
            success: function(result){
                console.log("aa "+result);
                alert( "Published !");
                $('#composeNews').summernote('code', '');
            }
        });

    }
</script>