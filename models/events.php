<?php
class Event {
    private $conn;
    private $table = "events";
    
    public $event_id;
    public $title;
    public $body;
    public $image;
    public $created_at;
    public $event_date;
    public $num_tickets;    
    public $reserved_tickets;
    public $category;
    
    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function create() {
        $sql =    
        'INSERT INTO ' . $this->table . 
        ' SET
        title = ?,
        body = ?,
        image = ?,
        event_date = ?,
        num_tickets = ?,
        category = ?
        ';
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute([$this->title,$this->body,$this->image,$this->event_date,$this->num_tickets,$this->category])){
            return true;
        }
        echo $stmt->error;
        return false;

    }

    public function readSingle() {
        $sql =    
        'SELECT * FROM ' . $this->table . 
        ' WHERE event_id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->event_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->event_id = $row["event_id"];
        $this->title = $row["title"];
        $this->body = $row["body"];
        $this->image = $row["image"];
        $this->created_at = $row["created_at"];
        $this->num_tickets = $row["num_tickets"];
        $this->category = $row["category"];
        $this->event_date = $row["event_date"];
        $this->reserved_tickets = $row["reserved_tickets"];
    }
    public function readSingleTitle() {
        $sql =    
        'SELECT * FROM ' . $this->table . 
        ' WHERE title = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$this->title]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $this->event_id = $row["event_id"];
        $this->title = $row["title"];
        $this->body = $row["body"];
        $this->image = $row["image"];
        $this->created_at = $row["created_at"];
        $this->num_tickets = $row["num_tickets"];
        $this->category = $row["category"];
        $this->event_date = $row["event_date"];
        $this->reserved_tickets = $row["reserved_tickets"];
    }
    public function read($string = "all", $date_to = false, $date_from = false) {
        

        if($date_from == date('Y-m-d H:i:s') && $date_to != false){
            if ($string != 'all')
            {
                $sql =    
                'SELECT * FROM ' . $this->table . ' WHERE category IN (' .$string.') AND event_date BETWEEN "'.$date_from.  '"  AND "'.$date_to.'" ORDER BY event_date ASC';
            }
            else 
            {
                $sql =    
                'SELECT * FROM ' . $this->table . ' WHERE  event_date BETWEEN "'.$date_from.  '"  AND "'.$date_to.'" ORDER BY event_date ASC';
            }
        } 
        else if($date_from != false && $date_to != false)
        {
            if ($string == 'all')
            {    
                $sql =    
                'SELECT * FROM ' . $this->table. 
                ' WHERE event_date >= "' .$date_from. '" AND event_date <= "' .$date_to. '" ORDER BY event_date ASC';
            }
            else 
            {
                $sql =    
                'SELECT * FROM ' . $this->table. 
                ' WHERE category IN (' .$string.') AND event_date >= "' .$date_from. '" AND event_date <= "' .$date_to. '" ORDER BY event_date ASC';                
            }
        }
        else if($date_to == false)
        {   
            if($string == "all"){
                $sql =    
                 'SELECT * FROM ' . $this->table . ' WHERE event_date >= "' .$date_from. '" ORDER BY event_date ASC';
            }
            else{
                $sql =    
                'SELECT * FROM ' . $this->table . ' WHERE category IN (' .$string.') AND event_date >= "'
               .$date_from. '" ORDER BY event_date ASC';
            }
        }

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();   
        return $stmt;
    }

    public function get_similar($inputString){
        $sql = "SELECT * FROM " .$this->table. " WHERE title LIKE '%" .$inputString. "%' ORDER BY created_at DESC LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    public function read_recent() {
        $sql =     
        'SELECT * FROM events ORDER BY created_at DESC';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }
    public function fetch_slideshow(){
        $sql = 'SELECT * FROM ' .$this->table. ' ORDER BY created_at DESC LIMIT 5';
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute();
        return $stmt;
    }

    public function update() {
        $sql =    
        'UPDATE ' . $this->table . 
        ' SET
        title = ?,
        body = ?,
        image = ?,
        event_date = ?,
        num_tickets = ?,
        category = ?
        WHERE event_id = ?';
        $stmt = $this->conn->prepare($sql);
        if($stmt->execute([$this->title,$this->body,$this->image,$this->event_date,$this->num_tickets,$this->category,$this->event_id])){
            return true;    
        }
        
        return false;
       
    }

    public function delete(){
        $sql0 = 'SELECT image FROM ' .$this->table. ' WHERE title = ?';
        $sql = 
        'DELETE FROM ' .$this->table. ' WHERE title = ?';
        $stmt0 = $this->conn->prepare($sql0);
        $stmt = $this->conn->prepare($sql);
        $stmt0->execute([$this->title]); 
        $row = $stmt0->fetch(PDO::FETCH_ASSOC);
        $this->image = $row["image"];
        if($stmt->execute([$this->title])){
            return true;
        }
        echo $stmt->error;
        return false;
    }
}
?>