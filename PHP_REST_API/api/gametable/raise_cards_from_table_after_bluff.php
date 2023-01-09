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
    $gameTable->setBurned($data->burned);
    // $gameTable->setOntable($data->ontable);
    $gameTable->setPlayerId($data->player_id);
    $gameTable->setOntable($data->bluff);

    //play card
    if($gameTable->raiseCardsFromTableAfterBluff()){
        echo json_encode(
            array('message' =>'card raised from table successfully')
        );
    }else{
        echo json_encode(
            array('message' =>'card was not raised from table')
        );
    }

