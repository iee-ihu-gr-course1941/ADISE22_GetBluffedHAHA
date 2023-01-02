<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');


    include_once '../../config/DbForUsers.php';
    //include_once '../../config/Database.php';
    include_once '../../models/GameCondition.php';

    // instantiate database
    $db = new Database;
    $db = $db->connect();

    // Instantiate player model
    $gameCondition = new GameCondition($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //set game condition
    $gameCondition->setPlayerTurn($data->p_turn);
    $gameCondition->setGameStatus($data->status);
    $gameCondition->setResult($data->result);

    //create player
    if($gameCondition->createGame()){
        echo json_encode(
            array('message' =>'create game')
        );
    }else{
        echo json_encode(
            array('message' =>'failed to create game')
        );
    }

