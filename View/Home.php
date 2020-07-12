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
    <div>

    </div>
    <div>
        <?php
            include_once '../Model/User.php';
            if((isset($_SESSION["current_user"]) || $_SESSION["current_user"] != null)&& unserialize($_SESSION['current_user'])->getRole()=="student"){
                echo ("
                    <br>
                    <div>
                        <p>".unserialize($_SESSION['current_user'])->getFname()."</p>
                        <p>".unserialize($_SESSION['current_user'])->getLname()."</p>
                        <p>".unserialize($_SESSION['current_user'])->getGender()."</p>
                        <p>".unserialize($_SESSION['current_user'])->getEmail()."</p>
                        <p>".unserialize($_SESSION['current_user'])->getDob()."</p>
                        <p>".unserialize($_SESSION['current_user'])->getTpnumber()."</p>
                        <p>".unserialize($_SESSION['current_user'])->getUser_id()."</p>
                        <p>".unserialize($_SESSION['current_user'])->getRole()."</p>
                    </div>
                "
                );

                echo '<img width="200px" src="data:image/jpg;base64,'.base64_encode(unserialize($_SESSION['current_user'])->getImage()).'" />';
            }

            if((isset($_SESSION["current_user"]) || $_SESSION["current_user"] != null)&& unserialize($_SESSION['current_user'])->getRole()=="lecturer"){

              include '../View/StaffHome.php';
            }

            if((isset($_SESSION["current_user"]) || $_SESSION["current_user"] != null)&& unserialize($_SESSION['current_user'])->getRole()=="admin"){

                include '../View/AdminHome.php';
              }
        ?>
    </div>

</div>
<?php $loadingPositon = 'footer'; include '../Common/CommonResources.php'; ?>
<script src="../res/js/Home.js"></script>

<?php
    $id = unserialize($_SESSION['current_user'])->getUser_id();
    echo "  <script>
                          showUnreadCount('".$id."');

            </script>";

?>
</body>

</html>
