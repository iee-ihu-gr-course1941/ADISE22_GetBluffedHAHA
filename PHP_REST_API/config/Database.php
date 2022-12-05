<?php
class Database{
    //DB parameters
    private $host = 'localhost';
    private $db = 'bluff_db';
    private $user = 'root';
    private $pass = 'adminalex';
    private $conn;
    

    public function connect(){
        $this->conn = null;

        try{
            $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db,
             $this->user, $this->pass);  
             $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  
        }catch(PDOException $e){
            echo 'connection failed: '.$e->getMessage();      
        }

        return $this->conn;
    }

}
    
?>