<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/CheckBluff.php';

    // instantiate database
    $db = new Database;
    $db = $db->connect();

    // Instantiate CheckBluff model
    $checkBluff = new CheckBluff($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));
    
    //$gameTable
    $checkBluff->setPlayerId($data->player_id);
    $checkBluff->setCardId($data->card_id);

    //create player
    if($checkBluff->addNewCheck()){
        echo json_encode(
            array('message' =>'added new check')
        );
    }else{
        echo json_encode(
            array('message' =>'failed to add new check')
        );
    }

