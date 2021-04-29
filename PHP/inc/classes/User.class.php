<?php
class User {

    public function __construct($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM users WHERE id = '" . $id . "'");

        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();

            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
        } else {
            return false;
        }
    }


    public function Update($type, $value) {
        global $mysqli;

        if($type == 'password') {
            $value = password_hash($value, PASSWORD_DEFAULT);
        }

        $mysqli->query("UPDATE users SET $type = '".$value."' WHERE id = '".$this->id."'");

        return true;
    }

    public static function Add($username, $password, $key) {
        global $mysqli;

        $password = password_hash($password, PASSWORD_DEFAULT);

        $mysqli->query("INSERT INTO users SET username = '".$username."', password = '".$password."', avatar = 'avatar.png', pubkey = '".$key."'");

        return true;
    }

    public static function CheckUsername($username) {
        global $mysqli;

        $query = $mysqli->query("SELECT id FROM users WHERE username = '".$username."'");

        if($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function Check($username, $password) {
        global $mysqli;

        $query = $mysqli->query("SELECT username, password FROM users WHERE username = '" . $username . "'");
        $row = $query->fetch_object();


        if (password_verify($password, $row->password)) {
            return true;
        } else {
            return false;
        }
    }

    public static function GetID($username) {
        global $mysqli;

        $query = $mysqli->query("SELECT id FROM users WHERE username = '".$username."'");
        $row = $query->fetch_object();

        return $row->id;
    }

    public static function CheckID($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT id FROM users WHERE id = '".$id."'");

        if($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function GetAll($username) {
        global $mysqli;
        global $user;

        $query = $mysqli->query("SELECT id FROM users WHERE id != '".$user->id."' AND username LIKE '%$username%'");

        while($row = $query->fetch_object()) {
            $return[$row->id] = new User($row->id);
        }

        return $return;
    }

}
?>