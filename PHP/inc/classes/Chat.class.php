<?php
class Chat {
    public function __construct($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM chat WHERE id = '" . $id . "'");

        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();

            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
        } else {
            return false;
        }
    }

    public function CheckChat() {
        global $mysqli;
        global $user;

        $query = $mysqli->query("SELECT id FROM chat WHERE (first = '".$user->id."' OR second = '".$user->id."') AND id = '".$this->id."'");

        if($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


    public static function Create($id) {
        global $mysqli;
        global $user;

        $mysqli->query("INSERT INTO chat SET first = '".$user->id."', second = '".$id."'");

        return true;
    }

    public static function GetID($id) {
        global $mysqli;
        global $user;

        $query = $mysqli->query("SELECT id FROM chat WHERE (first = '".$user->id."' AND second = '".$id."') OR (first = '".$id."' AND second = '".$user->id."')");
        
        if($query->num_rows > 0) {
            $row = $query->fetch_object();
            return $row->id;
        } else {
            return false;
        }
    }

    public static function Check($id) {
        global $mysqli;
        global $user;

        $query = $mysqli->query("SELECT id FROM chat WHERE (first = '".$user->id."' AND second = '".$id."') OR (first = '".$id."' AND second = '".$user->id."')");
        
        if($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function GetAll() {
        global $mysqli;
        global $user;

        $query = $mysqli->query("SELECT DISTINCT(c.id) AS id, MAX(m.id) FROM chat c LEFT JOIN chat_message m ON m.chat_id = c.id WHERE c.first = '" . $user->id . "' OR c.second = '" . $user->id . "' GROUP BY c.id ORDER BY MAX(m.id) DESC");

        while($row = $query->fetch_object()) {
            $return[$row->id] = new Chat($row->id);
        }

        return $return;
    }

    public static function CheckID($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT id FROM chat WHERE id = '".$id."'");

        if($query->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }


}
?>