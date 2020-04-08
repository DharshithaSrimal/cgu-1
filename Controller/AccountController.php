<?php
    include_once '../Common/DbCon.php';
    include_once '../Model/User.php';
    require_once "Mail.php";

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
            'username' => 'gmail.com',
            'password' => ''
        ));


        $firstName =$_POST['firstName'];
        $lastName =$_POST['lastName'];
        $email =$_POST['email'];

        $from = '<cgu@noreply.com>';
        $to = '<'.$email.'>';
        $subject = 'Hi!';
        $body = "Hi ".$firstName.",\n\nYour verification code is ".$verCode;

        $headers = array(
            'From' => $from,
            'To' => $to,
            'Subject' => $subject
        );

        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
            echo('<p>' . $mail->getMessage() . '</p>');
        } else {
            echo('<p>Message successfully sent!</p>');
        }

    }

    if($method == 'create_account'){

    }

    function generateVerificationCode(){
        return rand(100000,1000000)
    }

?>