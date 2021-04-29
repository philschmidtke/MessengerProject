<?php
class Message {

    public function __construct($id) {
        global $mysqli;

        $query = $mysqli->query("SELECT * FROM chat_message WHERE id = '" . $id . "'");

        if ($query->num_rows > 0) {
            $row = $query->fetch_assoc();

            foreach ($row as $key => $value) {
                $this->$key = $value;
            }
        } else {
            return false;
        }
    }


    public static function Add($chat, $status, $message) {
        global $mysqli;
        global $user;

        $time = time();

        $mysqli->query("INSERT INTO chat_message SET chat_id = '".$chat."', user_id = '".$user->id."', message = '".$message."', status = '".$status."', timestamp = '".$time."'");

        return true;
    }

    public static function GetLastMessage($chat) {
        global $mysqli;

        $query = $mysqli->query("SELECT message FROM chat_message WHERE chat_id = '".$chat."' AND status = '1' ORDER BY id DESC LIMIT 1");
        $row = $query->fetch_object();

        return $row->message;
    }

    public static function GetAll($chat) {
        global $mysqli;

        $query = $mysqli->query("SELECT id FROM chat_message WHERE chat_id = '".$chat."' AND status = '1'");

        while($row = $query->fetch_object()) {
            $return[$row->id] = new Message($row->id);
        }

        return $return;

    }

    //Verschlüsseln
    public static function Encrypt($text) {
        global $user;

        $value = base64_decode($user->pubkey);

        $encrypted = sodium_crypto_box_seal(
            $text,
            $value
        );
        
        return $encrypted;
    }

    //Entschlüsseln
    public static function Decrypt($text, $key) {

        $key = base64_decode($key);

        $decrypted = sodium_crypto_box_seal_open(
            $text,
            $key
        );
        
        return $decrypted;
    }



}
