<?php

    class GameCondition{
         //DB STUFF
         private $conn;
         private $table = 'game_condition';
 
         private $id;
         private $p_turn;
         private $status;
         private $last_change;
         private $result;
         
         //CONSTRUCTOR
         public function __construct($db)
         {
             $this->conn = $db;
         }
 
         //GETTERS
         public function getId(){
             return $this->id;
         }
 
         public function getPlayerTurn(){
             return $this->p_turn;
         }
         
         public function getGameStatus(){
             return $this->status;
         }
         
         public function getLastChange(){
             return $this->last_change;
         }
 
         public function getResult(){
             return $this->result;
         }

         //SETTERS
         public function setId($id){
             $this->id = $id;
        }

        public function setPlayerTurn($p_turn){
            $this->p_turn = $p_turn;
        }
        
        public function setGameStatus($status){
            $this->status = $status;
        }
        
        public function setLastChange($last_change){
            $this->last_change = $last_change;
        }

        public function setResult($result){
            $this->result = $result;
        }

        public function createGame(){
            $query = 'INSERT INTO ' 
            . $this->table 
            .' SET 
            p_turn =:p_turn,
            status =:status,
            result =:result,
            last_change =now()';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->p_turn= htmlspecialchars(strip_tags($this->p_turn));
            $this->status= htmlspecialchars(strip_tags($this->status));
            $this->last_change = htmlspecialchars(strip_tags($this->last_change));
            $this->result = htmlspecialchars(strip_tags($this->result));

            //Bind params
            $stmt -> bindParam(':p_turn',$this->p_turn);
            $stmt -> bindParam(':status',$this->status);
            $stmt -> bindParam(':result',$this->result);

            if($stmt->execute()){
                return true;
            }

            //print error if something went wrong
            printf("Error: %s.\n",$stmt->error);

            return false;

        }
        public function getCurrentGameCondition(){
            $query = 'SELECT  *
                        FROM ' . $this->table .
                         ' where id = :id';
            // print_r(json_encode($query));
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind id
            $stmt -> bindParam(":id",$this->id);

            //Execute query
            $stmt->execute();

            $row = $stmt-> fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->id = $row['id'];
            $this->p_turn = $row['p_turn'];
            $this->status = $row['status'];
            $this->last_change = $row['last_change'];

            return $stmt;
        }

         //CHANGE GAME STATUS
         public function changeStatus(){
            // Create query
            $query = 'UPDATE ' . $this->table . '
                                  SET status = :status,
                                  last_change = now()
                                  WHERE id = :id';
  
            // Prepare statement
            $stmt = $this->conn->prepare($query);
  
            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->p_turn= htmlspecialchars(strip_tags($this->p_turn));
            $this->status= htmlspecialchars(strip_tags($this->status));
            $this->last_change = htmlspecialchars(strip_tags($this->last_change));
            $this->result = htmlspecialchars(strip_tags($this->result));

            //Bind params
            $stmt -> bindParam(':id',$this->id);
            $stmt -> bindParam(':status',$this->status);
  
            // Execute query
            if($stmt->execute()) {
              return true;
            }
  
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
  
            return false;
         }

         //CHANGE GAME STATUS
         public function updatePlayerTurn(){
            // Create query
            $query = 'UPDATE ' . $this->table . '
                                set p_turn = :p_turn,
                                  last_change = now()
                                  WHERE id = :id';
            
             
            // Prepare statement
            $stmt = $this->conn->prepare($query);
            
            //clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->p_turn= htmlspecialchars(strip_tags($this->p_turn));
            $this->status= htmlspecialchars(strip_tags($this->status));
            $this->last_change = htmlspecialchars(strip_tags($this->last_change));
            $this->result = htmlspecialchars(strip_tags($this->result));

            //Bind params
            $stmt -> bindParam(':id',$this->id);
            $stmt -> bindParam(':p_turn',$this->p_turn);
  
            // Execute query
            if($stmt->execute()) {
              return true;
            }
  
            // Print error if something goes wrong
            printf("Error: %s.\n", $stmt->error);
  
            return false;
         }
    }