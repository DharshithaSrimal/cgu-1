<?php 
class DbCon{
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public static function connection() {

         $servername = "us-cdbr-iron-east-01.cleardb.net";
         $username = "bc000a9d35d22f";
         $password = "6580f159";
         $dbname = "heroku_6d77d31d03d7e6f";

        $conn = null;
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             echo "Connected successfully";
            }
        catch(PDOException $e)
            {
             echo "Connection failed: " . $e->getMessage();
            } 

        return $conn;
    }
}

?>