<?php
 header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/DbForUsers.php';
//include_once '../../config/Database.php';
include_once '../../models/Player.php';
// instantiate database
 $db = new Database;
 $db = $db->connect();

 // Instantiate player model
 $player = new Player($db);

 //Get id
 $player->setName(isset($_GET['name']) ? $_GET['name'] : die());

 //get player
 $player->get_player_with_name();

 //Create array
 $player_array = array(
    'id' => $player->getId(),
    'name' => $player->getName(),
    'created' => $player->getCreated()
 );

 //make json
 print_r(json_encode($player_array));