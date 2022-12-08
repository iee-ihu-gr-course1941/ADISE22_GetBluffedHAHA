<?php
class Database{
    //DB parameters
    // private $host = 'localhost';
    private $host = '/home/student/it/2018/it185186/mysql/run/mysql.sock';
    private $db = 'bluff_db';
    private $user = 'root';
    // private $pass = 'root'; //mikes password
    // private $pass = 'adminalex';//alex localhost
     private $pass = 'thisismydatabasepass';//alex users.iee.ihu.gr   
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