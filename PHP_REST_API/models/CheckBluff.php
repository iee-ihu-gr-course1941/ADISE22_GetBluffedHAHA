<?php
    class CheckBluff{
         //DB STUFF
         private $conn;
         private $table = 'check_bluff';

         private $id;
         private $player_id;
         private $card_id;
         private $last_changed;

         //CONSTRUCTOR
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //GETTERS
        public function getId(){
            return $this->id;
        }

        public function getPlayerId(){
            return $this->player_id;
        }
        
        public function getCardId(){
            return $this->card_id;
        }

        public function getLastChanged(){
            return $this->last_changed;
        }

        //SETTERS
        public function setPlayerId($player_id){
            $this->player_id = $player_id;
        }
         
        public function setCardId($card_id){
            $this->card_id = $card_id;
        }

        public function emptyCheckBluff(){
            $query = 'DELETE FROM ' 
            . $this->table;

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            if($stmt->execute()){
                return true;
            }

            //print error if something went wrong
            printf("Error: %s.\n",$stmt->error);

            return false;
        }

        public function addNewCheck(){
            $query = 'INSERT INTO ' 
            . $this->table 
            . ' SET 
            player_id =:player_id,
            card_id =:card_id
            ';

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->player_id = htmlspecialchars(strip_tags($this->player_id));
            $this->card_id = htmlspecialchars(strip_tags($this->card_id));
            $this->last_changed = htmlspecialchars(strip_tags($this->last_changed));

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Parameters
            $stmt -> bindParam(':player_id',$this->player_id);
            $stmt -> bindParam(':card_id',$this->card_id);

            if($stmt->execute()){
                return true;
            }

            //print error if something went wrong
            printf("Error: %s.\n",$stmt->error);

            return false;
        }

        public function checkIfCheckBluffIsEmpty(){

           $query = 'SELECT c.id,c.card_id,c.player_id,c.last_changed
                   FROM ' . $this->table. ' c ';


            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
             $stmt->execute();
             
            return $stmt;            
        }


    }
