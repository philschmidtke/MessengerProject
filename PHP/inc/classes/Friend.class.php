<?php
class Friend {
    public function __construct($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM users_friends WHERE id = '" . $id . "'");

        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();

            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
        } else {
            return false;
        }
    }

    public function Delete() {
        global $mysqli;

        $mysqli->query("DELETE FROM users_friends WHERE id = '".$this->id."'");

        return true;
    }

    public function Update($type, $value) {
        global $mysqli;

        $mysqli->query("UPDATE users_friends SET $type = '".$value."' WHERE id = '".$this->id."'");

        return true;
    }

    public static function Check($first, $second) {
        global $mysqli;

        $query = $mysqli->query("SELECT id FROM users_friends WHERE (one = '".$first."' AND two = '".$second."') OR (one = '".$second."' AND two = '".$first."')");

        if($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function Add($first, $second) {
        global $mysqli;
        $time = time();

        $mysqli->query("INSERT INTO users_friends SET one = '".$first."', two = '".$second."', status = '1', timestamp = '".$time."'");

        return true;
    }

    public static function GetID($first, $second) {
        global $mysqli;

        $query = $mysqli->query("SELECT id FROM users_friends WHERE (one = '".$first."' AND two = '".$second."') OR (one = '".$second."' AND two = '".$first."')");
    
        $row = $query->fetch_object();

        return $row->id;
    }

    public static function getRequest() {
        global $mysqli;
        global $user;

        $query = $mysqli->query("SELECT id FROM users_friends WHERE two = '".$user->id."' AND status = '1'");

        while($row = $query->fetch_object()) {
            $return[$row->id] = new Friend($row->id);
        }

        return $return;
    }

    public static function CheckID($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT id FROM users_friends WHERE id = '".$id."'");

        if($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
}
?>