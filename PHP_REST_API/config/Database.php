<?php
class Database{
    //DB parameters
    // private $host = 'localhost';
    private $host = 'users.iee.ihu.gr';
    private $db = 'bluff_db';
    private $user = 'root';
    // private $pass = 'root'; //mikes password
    private $pass = 'thisismydatabasepass';  
    private $conn;
    // private $instanceUnixSocket = getenv('/home/student/it/2018/it185186/mysql/run/mysql.sock');

    public function connect(){
        $this->conn = null;

        try{
            $this->conn = new mysqli($this->host, $this->user,$this->pass, $this->db,null,'/home/student/it/2018/it185186/mysql/run/mysql.sock');
            // $this->conn = new PDO('mysql:host='.$this->dsn.';dbname='.$this->db,
            //  $this->user, $this->pass);  
            //  $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  
        }catch(PDOException $e){
            echo 'connection failed: '.$e->getMessage();      
        }

        return $this->conn;
    }

}
    
?>