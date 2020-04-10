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
    <script src="../res/js/Profile.js"></script>
</head>

<body>
<div>
    <p>Inquiry page</p>
    <button>View Inquiry History</button><br><br>
    <div>
        <label for="inquiry">Select Inquiry Type:</label>
        <select id="inquiry">
            <option value="selection">Level one Subject Selection</option>
            <option value="optional">Optional Subjects</option>
            <option value="lorem">lorem ipsum</option>
            <option value="ipsum">lorem ipsum</option>
        </select>
        <br><br>
        <label for="composeInquiry">Compose Your Inquiry:</label>

        <textarea id="composeInquiry" rows="4" cols="50"></textarea>
    </div>
    <button>Send</button>
</div>

<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
</body>

</html>
<?php