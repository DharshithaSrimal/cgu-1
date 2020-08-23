<?php
session_start();
if (!isset($_SESSION["current_user"]) || $_SESSION["current_user"] == null) {
    header("Location: ./Login.php");
    exit();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CGU - Job Posting</title>
    <meta name="description" content="Career Guidance Unit - System">
    <meta name="author" content="CGU-UOK">
    <link rel="stylesheet" href="../res/css/editProfile.css">
    <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>
</head>

<body>
<div>
    <div>
        <h4 style="margin-left: 148px;">Job Posting</h4>
        <div class="container bootstrap snippets">
            <div class="row decor-default">
                <!-- include libraries(jQuery, bootstrap) -->
                <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
                        
                <!-- include summernote css/js -->
                <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
                <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
                <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.css" rel="stylesheet">
                
                <div>
                    <div class="row decor-default contacts-labels card bg-light mb-3  card-user" style="margin-left: 2px;">
                        <h4 class="card-header h5">Tags</h4>
                        <div>
                            <div class="row" style="margin:0 auto;padding-right: 10px; padding-left: 10px;">
                                <div class="autocomplete" style="width:400px;">
                                    <input id="myInput" class="form-control" type="text" name="myCountry" placeholder="Search tags">
                                </div>
                
                                <textarea id="tags" class="form-control" rows="2" maxlength="100"></textarea>
                                <button onclick="AddToTextBox()" style="margin-top: 10px;">Add</button>
                            </div>
                        </div>
                    </div>
                <button id="Searchmatching">Search Matching Students</button>
                <div id="matchingStudents"></div>
                </div>
                <div id="composeNews"></div>
                        
                <script>
                    $('#composeNews').summernote({
                        placeholder: 'Type your message',
                        tabsize: 2,
                        height: 370
                    });
                </script>
            
                <div  >
                    <input class="btn btn-info" id="publishNews" type="button" value="Publish">
                </div>
                
                <script>
                    $("#publishNews").click(function () {
                        publishNews();
                    });
                
                    function publishNews(){
                    
                        var content=  $('#composeNews').summernote('code');
                        content =  content.replace(/\+/g,'%2B');
                        var method = "publishJobs";
                    
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
            </div>
        </div>
    </div>
</div>
<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
<script src="../res/js/Job.js"></script>
<script>
    function AddToTextBox(){
            var tagval = document.getElementById("myInput").value;
            document.getElementById("tags").append(tagval + ",");
        }
</script>

</body>

</html>
