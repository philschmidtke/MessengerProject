<?php
//CONFIG

class Config  {
    var $host = '127.0.0.1';
    var $user = 'root';
    var $pass = 'test';
    var $db = 'chat';
    var $connect;

    function connect() {
        $con = mysqli_connect($this->host, $this->user, $this->pass, $this->db);
        if (!$con) {
            die('Verbindung zur Datenbank konnte nicht hergestellt werden!');
        } else {
            $this->connect = $con;
        }
        return $this->connect;
    }
}

$connection = new Config();
$mysqli = $connection->connect();


$_SITE = array(
  "name" => "Chat-System",
  "path" => "http://127.0.0.1",
);

?>
