<?php
class Database{
    //DB parameters
    // private $host = 'localhost';
    private $host = 'localhost';
    private $db = 'bluff_db';
    private $user = 'root';
    private $pass = 'thisismydatabasepass';//users password 
    private $conn;
    

    public function connect(){
        $this->conn = null;

        try{
            if(gethostname()=='users.iee.ihu.gr') {
                $this->conn = new PDO('mysql:unix_socket=/home/student/it/2018/it185186/mysql/run/mysql.sock;dbname=bluff_db',
                $this->user,$this->pass);  
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 
             }  
        }catch(PDOException $e){
            echo 'connection failed: '.$e->getMessage();      
        }

        return $this->conn;
    }

}
    
?>