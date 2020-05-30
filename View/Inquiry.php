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
    <title>CGU - Home</title>
    <meta name="description" content="Career Guidance Unit - System">
    <meta name="author" content="CGU-UOK">
    <link rel="stylesheet" href="../res/css/Home.css">
    <?php $loadingPositon = 'header'; include '../Common/CommonResources.php'; ?>
</head>

<body>
<div id="msg_main_div" class="container">
<div>
    <p>Inquiry page</p>
    <button class="btn btn-light" >View Inquiry History</button><br><br>
    <div>
        <label for="inquiry">Select Inquiry Type:</label>
        <select id="inquiryType" class="custom-select">
            <option value="Level one Subject Selection">Level one Subject Selection</option>
            <option value="Level two Subject Selection">Level two Subject Selection</option>
            <option value="Level three Subject Selection">Level three Subject Selection</option>
            <option value="Level four Subject Selection">Level four Subject Selection</option>
        </select>
        <br><br>
        <label for="composeInquiry">Compose Your Inquiry:</label>
        <br>
        <textarea id="composeInquiry" rows="4" cols="50"></textarea>

        <input class="btn btn-info" id="submitInquiry" type="button" value="Submit">
    </div>
</div>
    <div id="msg_div">
        <div class="my">
            <div class="d_time">2020 May 27 8:55 PM</div>
            <div class="msg_text">
                Hi i'm test 1
            </div>
            <div class="pro_pic_frame" >
                <img class="pro_pic" src="../res/img/testImage.jpg" />
            </div>
        </div>
        <div class="other">
            <div class="d_time">2020 May 27 8:55 PM</div>
            <div class="pro_pic_frame" >
                <img class="pro_pic" src="../res/img/testImage.jpg" />
            </div>
            <div class="msg_text">
                Hi i'm test 2
            </div>
        </div>
    </div>
</div>
<style>
    #composeInquiry{
    width:100%;
    }
    #msg_main_div{
        margin-top:30px;
        width: 100%;
        height:auto;
        background-color: rgb(234, 229, 231);
        border-radius:10px;
        padding:20px;
    }
    #msg_div{
        display: inline;
        height:auto;
        position: relative;
        margin:20px;
    }
    .my{
        background-color: rgb(213, 216, 208);
        width:100%;
        padding:10px;
        text-align:right;
        border-radius:5px;
        margin-top: 5px;
    }
    .other{
        background-color: rgb(255, 253, 253);
        width:100%;
        padding:10px;
        border-radius: 5px;
        margin-top: 5px;
    }
    .pro_pic{
        height :100%;
        position: relative;
    }
    .pro_pic_frame{
        display: inline-block;
        height: 30px;
        width: 30px;
        border-radius: 50%;
        margin: auto;
        overflow: hidden;
        position: relative;

    }

    .msg_text{
        display: inline;
        margin-top: -10px !important;
        margin-left: 10px;
        margin-right: 10px;
        font-weight:600;
        position: relative;
        top:-10px;
    }

    .d_time{
        font-style: italic;
        font-size:10px;
        position: relative;
        bottom: 5px;
    }
</style>

<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
<script src="../res/js/Inquiry.js"></script>
</body>

</html>
<?php