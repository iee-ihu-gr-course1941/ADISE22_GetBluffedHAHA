<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Authorization,X-Token');

    include_once '../../config/Database.php';
    include_once '../../models/Player.php';

    // instantiate database
    $db = new Database;
    $db = $db->connect();

    // Instantiate player model
    $player = new Player($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    // $player->setName('alex');
    $player->setName($data->name);
    //create player
    if($player->add_new_player()){
        echo json_encode(
            array('message'=>'New Player added successfully')
        );
        // print_r($_POST);
    }else{
        echo json_encode(
            array('message' =>'failed to add new player')
        );
    }

