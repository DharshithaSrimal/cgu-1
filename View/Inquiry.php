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
<div>
    <p>Inquiry page</p>
    <button>View Inquiry History</button><br><br>
    <div>
        <label for="inquiry">Select Inquiry Type:</label>
        <select id="inquiryType">
            <option value="Level one Subject Selection">Level one Subject Selection</option>
            <option value="Level two Subject Selection">Level two Subject Selection</option>
            <option value="Level three Subject Selection">Level three Subject Selection</option>
            <option value="Level four Subject Selection">Level four Subject Selection</option>
        </select>
        <br><br>
        <label for="composeInquiry">Compose Your Inquiry:</label>
        <textarea id="composeInquiry" rows="4" cols="50"></textarea>

        <input id="submitInquiry" type="button" value="Submit">
    </div>
</div>

<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
<script src="../res/js/Inquiry.js"></script>
</body>

</html>
<?php