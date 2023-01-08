<?php
 header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
// include_once '../../config/DbForUsers.php';
include_once '../../models/GameTable.php';

// instantiate database
 $db = new Database;
 $db = $db->connect();

 // Instantiate card model
 $gameTable = new GameTable($db);

//  //Get id
//  $gameTable->setPlayerId(isset($_GET['player_id']) ? $_GET['player_id'] : die());

 //cards query
 $result = $gameTable->getLastPlayedCards();
 //get row count
 $rowcount = $result->rowCount();

 if($rowcount > 0) {
    $gameTable_arr = array();
    $gameTable_arr['data'] = array();

    while($row =$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $gameTable_item = array(
            'id' => $id,
            'player_id' => $player_id,
            'card_id' => $card_id,
            'bluff' => $bluff
        );
        array_push($gameTable_arr['data'], $gameTable_item);
    }
    echo json_encode($gameTable_arr);
 }else{
    echo json_encode(
        array('message' => 'no table found'));
 }