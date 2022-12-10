<?php
class Database{
    //DB parameters
    // private $host = 'localhost';
    private $host = 'localhost';
    private $db = 'bluff_db';
    private $user = 'root';
    // private $pass = 'root'; //mikes password
    private $pass = 'thisismydatabasepass'; //mikes password
 // private $pass = 'adminalex';  
    private $conn;
    

    public function connect(){
        $this->conn = null;

        try{
            if(gethostname()=='users.iee.ihu.gr') {
            $this->conn = new PDO($this->host,$this->user, $this->pass,null,$this->db,'/home/student/it/2018/it185186/mysql/run/mysql.sock');  
            // $this->conn = new mysqli($this->host,$this->user, $this->pass,$this->db,null,'/home/student/it/2018/it185186/mysql/run/mysql.sock');
             } //  $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  
        }catch(PDOException $e){
            echo 'connection failed: '.$e->getMessage();      
        }

        return $this->conn;
    }

}
    
?>