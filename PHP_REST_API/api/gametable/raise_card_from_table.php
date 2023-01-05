<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/GameTable.php';

    // instantiate database
    $db = new Database;
    $db = $db->connect();

    // Instantiate GameTable model
    $gameTable = new GameTable($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

    //$gameTable
    $gameTable->setPlayerId($data->player_id);
    // $gameTable->setGameConditionId($data->game_condition_id);
    $gameTable->setCardId($data->card_id);
    $gameTable->setBurned($data->burned);
    $gameTable->setOntable($data->ontable);

    //play card
    if($gameTable->raiseCardFromTable()){
        echo json_encode(
            array('message' =>'card raised from table successfully')
        );
    }else{
        echo json_encode(
            array('message' =>'card was not raised from table')
        );
    }

