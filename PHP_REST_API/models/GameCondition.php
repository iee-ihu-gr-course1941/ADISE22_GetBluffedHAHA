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
             return $this->Result;
         }

         //CREATE NEW GAME
         public function createGame(){
            $query = 'INSERT INTO ' . $this->table . '(0,NULL,NULL)';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC); 

            echo json_encode(
                array('message' => 'game created with id' . $row['id']));

         }

         //CHANGE GAME STATUS
         public function changeStatus($id,$status){
            $query = 'UPDATE ' . $this->$table . 
                     'SET status = ? WHERE id = ?';

            //Prepare Statement
            $stmt = $this->conn->prepare($query);

            //Bind Parameters
            $stmt -> bindParam(1,$status);
            $stmt -> bindParam(2,$id);

            //Execute query
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC); 
         }
    }