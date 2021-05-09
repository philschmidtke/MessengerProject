<?php
//CONFIG

class Config  {
    var $host = '161.97.138.181';
    var $user = 'cicek_db2';
    var $pass = '';
    var $db = 'cicek_db2';
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
  "name" => "GhostChat",
  "path" => "https://chat.cicek.li",
);

?>
