<?php

    class GameTable{
        //DB STUFF
        private $conn;
        private $table = 'game_table';

        private $id;
        private $player_id;
        private $game_condition_id;
        private $card_id;
        private $burned;
        
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
        
        public function getGameConditionId(){
            return $this->game_condition_id;
        }
        
        public function getCardId(){
            return $this->card_id;
        }

        public function getBurned(){
            return $this->burned;
        }

        //READ TABLE
        public function read(){
            $query = 'SELECT  g.id, g.player_id, g.game_condition_id,  g.card_id, g.burned
                        FROM ' . $this->table . ' g ';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }

        //READ PLAYER HAND
        public function read_player_hand($player){
            $query = 'SELECT g.card_id
                        FROM ' . $this->table . ' g  
                        WHERE g.player_id = ?';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Parameter
            $stmt -> bindParam(1,$player);

            //Execute query
            $stmt->execute();

            $row = $stmt-> fetch(PDO::FETCH_ASSOC);

           return $stmt;
        }

        //READ PLAYER PLAYER HAND SIZE
        public function read_player_hand_size($player){
            $query = 'SELECT COUNT (g.card_id)
                        FROM ' . $this->table . ' g  
                        WHERE g.player_id = ?';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Parameter
            $stmt -> bindParam(1,$player);

            //Execute query
            $stmt->execute();

            $row = $stmt-> fetch(PDO::FETCH_ASSOC);

           return $stmt;
        }

        //ADD CARD ΙD TO PLAYER HAND
        public function addCard($player,$game_condition,$card){
            $query = 'INSERT INTO ' . $this->table . '(?,?,?,0)';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Parameters
            $stmt -> bindParam(1,$player);
            $stmt -> bindParam(2,$game_condition);
            $stmt -> bindParam(3,$card);

            //Execute query
            $stmt->execute();

            $row = $stmt-> fetch(PDO::FETCH_ASSOC);
        }



    }