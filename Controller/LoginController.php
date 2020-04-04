<?php 
    include_once '..\Common\DbCon.php';
    include_once '..\Model\User.php';

    $userName=$_POST['userName'];
    $pw=$_POST['pw'];
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

    session_start();
    $curr_user = verifyUser($userName,$pw);
    var_dump(serialize($curr_user));
    $_SESSION["current_user"] = serialize($curr_user);

?>