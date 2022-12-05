<?php

     class Card{
        //DB STUFF
        private $conn;
        private $table = 'cards';


        private $id;
        private $colour;
        private $number;

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

        public function getColour(){
            return $this->colour;
        }

        public function getNumber(){
            return $this->number;
        }

        public function read(){
            $query = 'SELECT  t.colour,t.id, t.number 
                        FROM ' . $this->table . ' t ';

            //Prepare statement
            $stmt = $this->conn->prepare($query);

            //Execute query
            $stmt->execute();

            return $stmt;
        }

        public function read_single_card(){
            $query = 'SELECT  t.colour,t.id, t.number 
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
            $this->colour = $row['colour'];
            $this->number = $row['number'];
            // return $stmt;
        }
        
     }