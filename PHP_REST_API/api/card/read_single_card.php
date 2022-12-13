<?php
 header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
// include_once '../../config/DbForUsers.php';
include_once '../../models/Card.php';
// instantiate database
 $db = new Database;
 $db = $db->connect();

 // Instantiate card model
 $card = new Card($db);

 //Get id
 $card->setId(isset($_GET['id']) ? $_GET['id'] : die());

 //get card
 $card->read_single_card();

 //Create array
 $card_array = array(
    'id' => $card->getId(),
    'colour' => $card->getColour(),
    'number' => $card->getNumber()
 );

 //make json
 print_r(json_encode($card_array));

