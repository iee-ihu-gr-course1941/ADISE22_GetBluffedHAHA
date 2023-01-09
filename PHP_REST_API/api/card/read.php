<?php
 header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../models/Card.php';

// instantiate database
 $db = new Database;
 $db = $db->connect();

 // Instantiate card model
 $card = new Card($db);

 //cards query
 $result = $card->read();
 //get row count
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
 }else{
    echo json_encode(
        array('message' => 'no table found'));
 }