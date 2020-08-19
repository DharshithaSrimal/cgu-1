<?php
    include_once '../Common/DbCon.php';
    include_once '../Model/User.php';
    require_once "Mail.php";
    @date_default_timezone_set('	Asia/Colombo');

    session_start();

    $method;

    if(!empty($_POST['method'])) {
        $method = $_POST['method'];
    }

    if($method == 'verify_email'){

        $smtp = Mail::factory('smtp', array(
            'host' => 'ssl://smtp.gmail.com',
            'port' => '465',
            'auth' => true,
            'username' => 'developmentproject2020@gmail.com',
            'password' => 'developmentproject'
        ));

        $firstName =$_POST['firstName'];
        $lastName =$_POST['lastName'];
        $email =$_POST['email'];

        $verCode=generateVerificationCode();

        //$verCode should be saved in verification_code_store table
        $con = DbCon::connection();
        $sql = "INSERT INTO verification_code_store(email,verification_code,created_time) VALUES ('".$email."',".$verCode.",'".date("Y-m-d H:i:s")."')";
        try{
            $res=$con->query($sql);
        }catch (PDOException $e){

        }
        $con = null; //closing connection

        $from = '<cgu@noreply.com>';
        $to = '<'.$email.'>';
        $subject = 'Verification Code - Career Guidance Unit - UOK';
        $body = "Hi ".$firstName."!,\n\nYour verification code is ".$verCode;

        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject
        );

        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
            echo('<p> ver. code:' .$verCode.' error:'. $mail->getMessage() . '</p>');
        } else {
            echo('<p>Message successfully sent! '.$verCode.'</p>');
        }
    }

    if($method == 'create_account'){
        //verification code should be checked first
        $enteredVerCode =$_POST['verCode'];
        $email =$_POST['email'];

        $user_id= $_POST['user_id'];
        $fname=$_POST['fname'];
        $lname=$_POST['lname'];
        $gender=$_POST['gender'];
        $dob=$_POST['dob'];
        $tpnumber=$_POST['tpnumber'];
        $user_role=$_POST['user_role'];
        $image;
        if(isset($_FILES['image']) and !$_FILES['image']['error']){
            $image= addslashes(file_get_contents($_FILES['image']['tmp_name']));
        }
        $password=$_POST['password'];

        $con = DbCon::connection();
        $sql = "SELECT *  FROM verification_code_store v WHERE v.email='".$email."'ORDER BY created_time DESC LIMIT 1 ";
        try{
            $res=$con->query($sql);
        }catch (PDOException $e){

        }

        if($res){
            $codeValidTime;
            $codeCreatedTime;
            $lastCode;

            $currentTime = new DateTime(date("Y-m-d H:i:s"));

            while($row = $res->fetch(PDO::FETCH_BOTH)){
                $codeValidTime = $row["valid_for_minutes"];
                $codeCreatedTime = new DateTime($row["created_time"]);
                $lastCode = $row["verification_code"];
            }

            if($lastCode == $enteredVerCode){
                $timeDif = $currentTime ->Diff($codeCreatedTime);
                if($timeDif->format('%y')>0||$timeDif->format('%m')>0
                ||$timeDif->format('%a')||$timeDif->format('%h')>0
                ||$timeDif->format('%i')>60){
                    echo "Verification code is expired";
                }
                else{
                    //save account details to the database
                     $sql = "INSERT INTO user
                     (user_id,fname,lname,email,
                     password,dob,tpnumber,image,
                     user_role,gender)
                     VALUES
                     ('".$user_id."','".$fname."','".$lname."','".$email."',
                     '".$password."','".$dob."','".$tpnumber."','".$image."',
                     '".$user_role."','".$gender."');
                     ";
                    try{
                        $res=$con->query($sql);
                    }catch (PDOException $e){

                    }
                    echo "Account created";
                }
            }
            else{
                echo "Invalid verification code";
            }
        }
        $con = null; //closing connection

    }

    function generateVerificationCode(){
        return rand(100000,1000000);
    }

?>