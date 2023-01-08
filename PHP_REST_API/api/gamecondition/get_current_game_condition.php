<?php
 header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
// include_once '../../config/DbForUsers.php';
include_once '../../models/GameCondition.php';
// instantiate database
 $db = new Database;
 $db = $db->connect();

 // Instantiate card model
 $gameCond = new GameCondition($db);

 //Get id
 $gameCond->setId(isset($_GET['id']) ? $_GET['id'] : die());

 //get game condition
 $gameCond->getCurrentGameCondition();

 //Create array
 $game_condition_array = array(
    'id' => $gameCond->getId(),
    'p_turn' =>$gameCond->getPlayerTurn(),
    'status' => $gameCond->getGameStatus(),
    'last_change' =>$gameCond->getLastChange()
 );

 //make json
 print_r(json_encode($game_condition_array));

