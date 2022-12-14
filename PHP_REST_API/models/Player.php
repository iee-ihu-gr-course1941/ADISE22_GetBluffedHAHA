<?php 
    class Player{
        //DB STUFF
        private $conn;
        private $table = 'players';


        private $id;
        private $name;
        private $created;
        private $token;

        public function __construct($db)
        {
            $this->conn = $db;
        }

        public function getId(){
            return $this->id;
        }

        public function setId($id){
            $this->id = $id;
        }

        
        public function getName(){
            return $this->name;
        }

        public function getToken(){
            return $this->token;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getCreated(){
            return $this->created;
        }

        public function setToken($token){
            $this->token = $token;
        }
        public function read(){
            $query = 'SELECT  t.id,t.name, t.created, t.token
                        FROM ' . $this->table . ' t ';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }

        public function read_single_player(){
            $query = 'SELECT  t.id,t.name, t.created 
                        FROM ' . $this->table .
                         ' t  where t.id = ? LIMIT 0,1';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind id
            $stmt -> bindParam(1,$this->id);

            //Execute query
            $stmt->execute();

            $row = $stmt-> fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->created = $row['created'];

        }

        public function get_player_with_name(){
            $query = 'SELECT  t.id,t.name, t.created,t.token
                        FROM ' . $this->table .
                         ' t  where t.name = ? LIMIT 0,1';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind id
            $stmt -> bindParam(1,$this->name);

            //Execute query
            $stmt->execute();

            $row = $stmt-> fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->created = $row['created'];
            $this->token = $row['token'];
        }

        public function add_new_player(){
            $query = 'INSERT INTO ' 
            . $this->table 
            .' SET 
            name =:name,
            token = md5(:name) ';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->created = htmlspecialchars(strip_tags($this->created));

            //Bind params
            // $stmt -> bindParam(':id',$this->id);
            $stmt -> bindParam(':name',$this->name);

            if($stmt->execute()){
                return true;
            }

            //print error if something went wrong
            printf("Error: %s.\n",$stmt->error);

            return false;

        }

        public function update_player() {
            // Create query
            $query = 'UPDATE ' . $this->table . '
                                  SET name = :name
                                  WHERE id = :id';
  
            // Prepare statement
            $stmt = $this->conn->prepare($query);
  
            // Clean data
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->id = htmlspecialchars(strip_tags($this->id));
  
            //Bind params
            $stmt -> bindParam(':name',$this->name);
            $stmt -> bindParam(':id',$this->id);
  
            // Execute query
            if($stmt->execute()) {
              return true;
            }
  
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
  
            return false;
      }
      
      //delete post
     public function delete_player(){
        $query = 'DELETE 
         FROM ' . $this->table . ' 
         WHERE id = :id';
   
        //prepare statement
        $stmt = $this->conn->prepare($query);
   
        //clean data, ginontai submit opote theloume na ta katharisoume
        $this->id=htmlspecialchars(strip_tags($this->id));
        //bind data, ta panw tou query
        $stmt->bindParam(':id', $this->id);
        //execute query
        if($stmt->execute()){
             return true;
     
        }else{
             //print error if something wrong
             printf("Error: %s.\n", $stmt->error);
     
             return false;
        }
       } 

        
        
     }