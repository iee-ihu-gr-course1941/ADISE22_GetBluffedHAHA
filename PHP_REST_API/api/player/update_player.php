<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/DbForUsers.php';
  //include_once '../../config/Database.php';
  include_once '../../models/Player.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog post object
  $player = new Player($db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $player->setId($data->id);

  $player->setName($data->name);

  // Update post
  if($player->update_player()) {
    echo json_encode(
      array('message' => 'Player Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'Player Not Updated')
    );
}