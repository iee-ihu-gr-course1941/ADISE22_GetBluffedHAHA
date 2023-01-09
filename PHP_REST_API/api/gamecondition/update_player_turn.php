<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/GameCondition.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $gameCondition = new GameCondition($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $gameCondition->setId($data->id);

  $gameCondition->setPlayerTurn($data->p_turn);

  // Update post
  if($gameCondition->updatePlayerTurn()) {
    echo json_encode(
      array('message' => 'player turn changed')
    );
  } else {
    echo json_encode(
      array('message' => 'player turn failed to change')
    );
}