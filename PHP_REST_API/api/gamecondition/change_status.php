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

  $gameCondition->setGameStatus($data->status);

  // Update post
  if($gameCondition->changeStatus()) {
    echo json_encode(
      array('message' => 'Status changed')
    );
  } else {
    echo json_encode(
      array('message' => 'Status failed to change')
    );
}