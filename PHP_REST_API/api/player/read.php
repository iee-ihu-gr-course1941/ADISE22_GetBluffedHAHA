<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Authorization,X-Token');

include_once '../../config/Database.php';
include_once '../../models/Player.php';

// instantiate database
 $db = new Database;
 $db = $db->connect();

 // Instantiate player model
 $player = new Player($db);

 //players query
 $result = $player->read();

 //get row count
 $rowcount = $result->rowCount();

 if($rowcount > 0) {
    $player_arr = array();
    $player_arr['data'] = array();

    
    while($row =$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $player_item = array(
            'id' => $id,
            'name' => $name,
            'created' => $created,
            'token' => $token

        );
        array_push($player_arr['data'], $player_item);


    }
    echo json_encode($player_arr);
 }else{
    echo json_encode(
        array('message' => 'no table found'));
 }