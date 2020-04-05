<?php
    include_once '..\Common\DbCon.php';
    include_once '..\Model\User.php';

    session_start();

    $userName;
    $pw;
    $method;

    if(!empty($_POST['method'])) {
        $method =$_POST['method'];
    }
    if(!empty($_POST['userName'])) {
        $userName=$_POST['userName'];
    }
    if(!empty($_POST['pw'])) {
        $pw=$_POST['pw'];
    }

    if($method == 'login' && isset($pw) && isset($userName)){
        //echo $userName;
        function verifyUser($userName,$pw){

            $con = DbCon::connection();
            $sql="select * from user where user.user_id = '".$userName."' and user.password = '".$pw."'";
            $res=$con->query($sql);
            $conn = null; //closing connection
            if($res)
            {
                $user_obj = new User();
                while($row = $res->fetch(PDO::FETCH_BOTH)){
                    $user_obj->setFname($row["fname"]);
                    $user_obj->setLname($row["lname"]);
                    $user_obj->setEmail($row["email"]);
                    $user_obj->setDob($row["dob"]);
                    $user_obj->setUser_id($row["user_id"]);
                    $user_obj->setTpnumber($row["tpnumber"]);
                    $user_obj->setImage($row["image"]);
                }
                return $user_obj;
            }
            else
            {
                return null;
            }
        }
        $curr_user = verifyUser($userName,$pw);
        $_SESSION["current_user"] = serialize($curr_user);
        echo "login success";
    }


    if($method == 'logout'){
        session_unset();
        session_destroy();
        echo "logout success";
    }

?>