<?php
include_once '../../models/Card.php';
    class GameTable{
        //DB STUFF
        private $conn;
        private $table = 'game_table';

        private $id;
        private $player_id;
        private $game_condition_id;
        private $card_id;
        private $burned;
        private $ontable;
        private $bluff;
        
        //CONSTRUCTOR
        public function __construct($db)
        {
            $this->conn = $db;
        }

        //SETTERS
        public function setPlayerId($player_id){
            $this->player_id = $player_id;
        }
        
        public function setGameConditionId($game_condition_id){
            $this->game_condition_id = $game_condition_id;
        }
        
        public function setCardId($card_id){
            $this->card_id = $card_id;
        }

        public function setBurned($burned){
            $this->burned = $burned;
        }
        public function setOntable($ontable){
            $this->ontable = $ontable;
        }
        public function setBluff($bluff){
            $this->bluff = $bluff;
        }
        // GETTERS
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
        public function getOntable(){
            return $this->ontable;
        }
        public function getBluff(){
            return $this->bluff;
        }

        //READ TABLE
        public function getLastPlayedCards(){
            $query = 'SELECT  g.id, cb.player_id,g.card_id,g.bluff
                        FROM ' . $this->table . ' g 
                        JOIN check_bluff cb 
                        ON g.card_id = cb.card_id';

             //Prepare statement
             $stmt = $this->conn->prepare($query);

            //  //Bind player_id
            //  $stmt -> bindParam(1,$this->player_id);
 
             //Execute query
             $stmt -> execute();
 
             return $stmt;
        }

        //RAISE CARDS FROM TABLE AFTER BLUFF
        public function raiseCardsFromTableAfterBluff(){
            $query = 'UPDATE ' 
            . $this->table 
            . ' SET 
            player_id =:player_id,
            burned =:burned,
            bluff =:bluff
            where ontable =1
            ';

             //Prepare statement
             $stmt = $this->conn->prepare($query);

            ///Bind Parameters
            $stmt -> bindParam(':player_id',$this->player_id);
            $stmt -> bindParam(':burned',$this->burned);
            // $stmt -> bindParam(':ontable',$this->ontable);
            $stmt -> bindParam(':bluff',$this->bluff);
 
            if($stmt->execute()){
                return true;
            }

            //print error if something went wrong
            printf("Error: %s.\n",$stmt->error);

            return false;
        }

        //GET PLAYER HAND
        public function get_player_hand(){
            $query = 'select c.colour,c.id,c.number
                        from cards c
                        join ' . $this->table .' gt on
                        c.id = gt.card_id
                        where player_id = ?';
            
            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind player_id
            $stmt -> bindParam(1,$this->player_id);

            //Execute query
            $stmt -> execute();

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
        public function addCard(){
            $query = 'INSERT INTO ' 
            . $this->table 
            . ' SET 
            player_id =:player_id,
            game_condition_id =:game_condition_id,
            card_id =:card_id,
            burned =:burned,
            ontable = 0
            ';

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->player_id = htmlspecialchars(strip_tags($this->player_id));
            $this->game_condition_id = htmlspecialchars(strip_tags($this->game_condition_id));
            $this->card_id = htmlspecialchars(strip_tags($this->card_id));
            $this->burned = htmlspecialchars(strip_tags($this->burned));
            $this->ontable = htmlspecialchars(strip_tags($this->ontable));

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Parameters
            $stmt -> bindParam(':player_id',$this->player_id);
            $stmt -> bindParam(':game_condition_id',$this->game_condition_id);
            $stmt -> bindParam(':card_id',$this->card_id);
            $stmt -> bindParam(':burned',$this->burned);

            if($stmt->execute()){
                return true;
            }

            //print error if something went wrong
            printf("Error: %s.\n",$stmt->error);

            return false;
        }

        public function playCard(){
            $query = 'UPDATE ' 
            . $this->table 
            . ' SET 
            player_id =null,
            burned =:burned,
            ontable = :ontable,
            bluff =:bluff
            where card_id =:card_id
            ';

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->player_id = htmlspecialchars(strip_tags($this->player_id));
            $this->game_condition_id = htmlspecialchars(strip_tags($this->game_condition_id));
            $this->card_id = htmlspecialchars(strip_tags($this->card_id));
            $this->burned = htmlspecialchars(strip_tags($this->burned));
            $this->ontable = htmlspecialchars(strip_tags($this->ontable));
            $this->bluff = htmlspecialchars(strip_tags($this->bluff));

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Parameters
            // $stmt -> bindParam(':player_id',$this->player_id);
            $stmt -> bindParam(':card_id',$this->card_id);
            $stmt -> bindParam(':burned',$this->burned);
            $stmt -> bindParam(':ontable',$this->ontable);
            $stmt -> bindParam(':bluff',$this->bluff);

            if($stmt->execute()){
                return true;
            }

            //print error if something went wrong
            printf("Error: %s.\n",$stmt->error);

            return false;
        }

        public function raiseCardFromTable(){
            $query = 'UPDATE ' 
            . $this->table 
            . ' SET 
            player_id =:player_id,
            burned =:burned,
            ontable = :ontable
            where card_id =:card_id
            ';

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->player_id = htmlspecialchars(strip_tags($this->player_id));
            $this->game_condition_id = htmlspecialchars(strip_tags($this->game_condition_id));
            $this->card_id = htmlspecialchars(strip_tags($this->card_id));
            $this->burned = htmlspecialchars(strip_tags($this->burned));
            $this->ontable = htmlspecialchars(strip_tags($this->ontable));

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Parameters
            $stmt -> bindParam(':player_id',$this->player_id);
            $stmt -> bindParam(':card_id',$this->card_id);
            $stmt -> bindParam(':burned',$this->burned);
            $stmt -> bindParam(':ontable',$this->ontable);

            if($stmt->execute()){
                return true;
            }

            //print error if something went wrong
            printf("Error: %s.\n",$stmt->error);

            return false;
        }

        public function burnCardFromTable(){
            $query = 'UPDATE ' 
            . $this->table 
            . ' SET 
            burned =:burned,
            ontable = :ontable
            where card_id =:card_id
            ';

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->player_id = htmlspecialchars(strip_tags($this->player_id));
            $this->game_condition_id = htmlspecialchars(strip_tags($this->game_condition_id));
            $this->card_id = htmlspecialchars(strip_tags($this->card_id));
            $this->burned = htmlspecialchars(strip_tags($this->burned));
            $this->ontable = htmlspecialchars(strip_tags($this->ontable));

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind Parameters
            // $stmt -> bindParam(':player_id',$this->player_id);
            $stmt -> bindParam(':card_id',$this->card_id);
            $stmt -> bindParam(':burned',$this->burned);
            $stmt -> bindParam(':ontable',$this->ontable);

            if($stmt->execute()){
                return true;
            }

            //print error if something went wrong
            printf("Error: %s.\n",$stmt->error);

            return false;
        }

        




    }