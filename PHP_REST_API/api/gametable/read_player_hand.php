<?php
 header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/GameTable.php';
// instantiate database
 $db = new Database;
 $db = $db->connect();

 // Instantiate card model
 $gameTable = new GameTable($db);


 $result = $gameTable->read_player_hand(isset($_GET['player']));
 $rowcount = $result->rowCount();



 if($rowcount > 0) {
    $card_arr = array();
    $card_arr['data'] = array();

    while($row =$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $card_item = array(
            'id' => $id,
            'colour' => $colour,
            'number' => $number

        );
        array_push($card_arr['data'], $card_item);


    }
    echo json_encode($card_arr);
}

