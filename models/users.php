<?php

use JetBrains\PhpStorm\Internal\ReturnTypeContract;

class User {
    private $conn;
    private $table = "users";
    public $user_id;
    public $event_id;
    public $username;   
    public $email;
    public $password;
    public $is_admin;
    public $friend_id;
    public $receiver_id;
    public $profile_image;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create() { 
        $sql =    
        'INSERT INTO ' . $this->table . 
        ' SET
        username = ?,
        email = ?,
        password = ?,
        profile_image = ?
        ';
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute([$this->username,$this->email,$this->password,$this->profile_image])){
            return true;
        }
        echo $stmt->error;
        return false;

    }
    public function checkUser() { 
        $sql =    
        'SELECT user_id, password, is_admin, email, profile_image FROM ' . $this->table . 
        ' WHERE username = ? OR email = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->username, $this->email]);
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->user_id = $row['user_id'];
            $this->password = $row['password'];
            $this->is_admin = $row['is_admin'];
            $this->email = $row['email'];
            $this->profile_image = $row['profile_image'];
            return true;
        }
        return false;

    }
    public function delete_user() {
        $sql = 'DELETE FROM ' . $this->table . 
        ' WHERE user_id = '.$this->user_id;
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    


    public function change_username() {
        $sql = 
        'UPDATE ' . $this->table . ' SET username = "' .$this->username.  '" WHERE user_id = ' . $this->user_id;
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()){
            return true;
        }
        return false;
    }   

    public function checkPass() {
        $sql = 
        'SELECT password FROM ' . $this->table . ' WHERE user_id = ' . $this->user_id;
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        if($stmt->rowCount() > 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->password = $row['password'];
        }

    }   
    public function updateProfileImage() {
        $sql = 
        'UPDATE '.$this->table. ' SET profile_image = ? WHERE user_id = ?';
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute([$this->profile_image, $this->user_id])){
            return true;
        }
        return false;
    }  
    public function changePass() {
        $sql = 
        'UPDATE ' . $this->table . ' SET password = "' .$this->password.  '" WHERE user_id = ' . $this->user_id;
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
    public function add_favorite() {
        $sql= 
        'INSERT INTO favorites
        SET
        user_id = ?,
        event_id = ?';
        $sql_2 = 
        "UPDATE events SET num_favorites = num_favorites + 1
        WHERE event_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt_2 = $this->conn->prepare($sql_2);
        if($stmt->execute([$this->user_id,$this->event_id]) && $stmt_2->execute([$this->event_id])) {
            return 1;
        }
        else{
            return 0;
        }
    }
    public function remove_favorite() {
        $sql= 
        'DELETE FROM favorites
        WHERE user_id = ? AND event_id = ?';
        $sql_2 = 
        "UPDATE events SET num_favorites = num_favorites - 1
        WHERE event_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt_2 = $this->conn->prepare($sql_2);
        if($stmt->execute([$this->user_id,$this->event_id]) && $stmt_2->execute([$this->event_id])) {
            return true;
        }
        else{
            return false;
        }
    }

    public function get_user_events() {
        $sql= 
        'SELECT * FROM events WHERE event_id IN (
            SELECT event_id FROM bookings WHERE user_id = ?
            ) OR event_id IN (
                SELECT event_id FROM favorites WHERE user_id = ?
            ) ORDER BY event_date DESC';   
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->user_id, $this->user_id]);
        return $stmt;
    }

    public function get_reservations() {
        $sql= 
        'SELECT * FROM events as e INNER JOIN bookings as b
        ON e.event_id = b.event_id
        WHERE b.user_id = ? AND e.event_date >= "'.date('Y-m-d H:i:s'). '" 
        ORDER BY e.event_date DESC'; 
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute([$this->user_id])) {
            return $stmt;
        }
         return false;
    }
    public function get_favorites() {
        $sql= 
        'SELECT * FROM events as e INNER JOIN favorites as f
        ON e.event_id = f.event_id
        WHERE f.user_id = ? AND e.event_date >= "'.date('Y-m-d H:i:s'). '" 
        ORDER BY e.event_date DESC'; 
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute([$this->user_id])) {
            return $stmt;
        }
         return false;
    }

    public function check_favorite() {
        $sql= 
        'SELECT * FROM favorites
        WHERE user_id = ? AND event_id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->user_id,$this->event_id]);
        if($stmt->rowCount() > 0){
            return 1;
        }
        return 0;
    }

    public function check_reservation() {
        $sql= 
        'SELECT * FROM bookings
        WHERE user_id = ? AND event_id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->user_id,$this->event_id]);
        if($stmt->rowCount() > 0){
            return 1;
        }
        return 0;
    }

    public function book_event() {
        $query = "SELECT reserved_tickets, num_tickets FROM events WHERE event_id = ?";
        $stmt0 = $this->conn->prepare($query);
        $stmt0->execute([$this->event_id]);
        $res = $stmt0->fetch(PDO::FETCH_ASSOC);
        if($res['reserved_tickets'] < $res['num_tickets']){
            $sql= 
            'INSERT INTO bookings
            SET
            user_id = ?,
            event_id = ?';
            $sql_2 = 
            "UPDATE events SET reserved_tickets = reserved_tickets + 1
            WHERE event_id = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt_2 = $this->conn->prepare($sql_2);
            if($stmt->execute([$this->user_id,$this->event_id])&& $stmt_2->execute([$this->event_id])) {
                return true;
            }
            else{
                return false;
            }
        }
    }
    public function remove_booking() {
        $sql= 
        'DELETE FROM bookings
        WHERE user_id = ? AND event_id = ?';
         $sql_2 = 
         "UPDATE events SET reserved_tickets = reserved_tickets - 1
         WHERE event_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt_2 = $this->conn->prepare($sql_2);
        if($stmt->execute([$this->user_id,$this->event_id])&& $stmt_2->execute([$this->event_id])) {
            return true;
        }
        else{
            return false;
        }
    }
    public function get_friends() {
        $sql = 
        'SELECT u.username, u.profile_image, uf.friend_id FROM users as u INNER JOIN user_friends as uf
        ON u.user_id = uf.friend_id
        WHERE uf.user_id = ?';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->user_id]);
        return $stmt;
        
    }
    public function checkFriend() {
        $sql = 
        'SELECT u.username FROM users as u INNER JOIN user_friends as uf
        ON u.user_id = uf.friend_id
        WHERE uf.user_id = ? AND u.username = ?';

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->user_id, $this->username]);
        if($stmt->rowCount() !== 0){
            return true;
        }
        return false;
    }


    public function get_user() {
        $sql = 
        'SELECT user_id, profile_image, username, is_admin, email FROM users WHERE username = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->username]);
        if($stmt->rowCount() !== 0){
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->user_id = $row["user_id"];
            $this->profile_image = $row["profile_image"];
            $this->username = $row["username"];
            $this->is_admin = $row["is_admin"];
            $this->email = $row["email"];
            return true;
        }
        return false;
  
    }
    
    public function add_friend() {
        $sql_1 = 
        'INSERT INTO user_friends
        SET
        user_id = ?,
        friend_id = ?';

        $sql_2 = 
        'INSERT INTO user_friends
        SET
        user_id = ?,
        friend_id = ?';
        $stmt_1 = $this->conn->prepare($sql_1);
        $stmt_2 =  $this->conn->prepare($sql_2);
        if($stmt_1->execute([$this->user_id,$this->friend_id]) &&  $stmt_2->execute([$this->friend_id,$this->user_id])) {
            return true;
        }
        else{
            return false;
        }
    }

    public function addRequest() {

        $sql= 
            'INSERT INTO requests
            SET
            sender_id = ?,
            receiver_id = ?';
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute([$this->user_id, $this->receiver_id])) {
                return true;
            }
            else{
                return false;
            }
    }

    public function removeRequest() {

        $sql= 
            'DELETE FROM requests
            WHERE
            sender_id = ? AND receiver_id = ?';
            $stmt = $this->conn->prepare($sql);
            if($stmt->execute([$this->user_id, $this->receiver_id])) {
                return true;
            }
            else{
                return false;
            }
    }

    public function remove_friend() {

        $sql0= 
            'DELETE FROM user_friends
            WHERE
            user_id = ? AND friend_id = ?';

        $sql1= 
        'DELETE FROM user_friends
        WHERE
        user_id = ? AND friend_id = ?';

            $stmt0 = $this->conn->prepare($sql0);
            $stmt1 = $this->conn->prepare($sql1);
            if($stmt0->execute([$this->user_id, $this->friend_id]) && $stmt1->execute([$this->friend_id,$this->user_id])) {
                return true;
            }
            else{
                return false;
            }
    }

        public function get_requests() {
        $sql = 
        'SELECT u.username, u.profile_image, u.user_id FROM users as u INNER JOIN requests as r
        ON u.user_id = r.sender_id
        WHERE r.receiver_id = ?';

        $stmt = $this->conn->prepare($sql);
        if($stmt->execute([$this->user_id])) {
            return $stmt;
        }
    }
    public function get_similar() {
        $sql = 
        'SELECT username, profile_image FROM ' .$this->table. ' WHERE username LIKE "%' .$this->username. '%"  AND is_admin = 0';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
}
?>