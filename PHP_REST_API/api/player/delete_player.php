<?php
   //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




    include_once '../../config/Database.php';
    include_once '../../models/Player.php';

   //instantiate db & connect
    $database = new Database();
    $db = $database->connect();

   //instantiate blog post object
    $player = new Player($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //set id to delete
    $player->setId($data->id);
   // $player->id = $data->id;
   // $player->setName($data->name);


   //delete post
   if($player->delete_player()){
    echo json_encode(
        array('message' => 'Player Deleted')
    );
    }else{
         echo json_encode(
           array('message' => 'Player Not Deleted')
         );
    }
  



