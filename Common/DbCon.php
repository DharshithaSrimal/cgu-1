<?php 
class DbCon{
    private $servername = "us-cdbr-iron-east-01.cleardb.net";
    private $username = "bc000a9d35d22f";
    private $password = "6580f159";
    private $dbname = "heroku_6d77d31d03d7e6f";

    public static function connection() {
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