<?php
   //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/CheckBluff.php';

   //instantiate db & connect
    $database = new Database();
    $db = $database->connect();

   //instantiate blog post object
    $checkbluff = new CheckBluff($db);

    //get raw posted data
    $data = json_decode(file_get_contents("php://input"));

   //delete post
   if($checkbluff->emptyCheckBluff()){
    echo json_encode(
        array('message' => 'check bluff empty')
    );
    }else{
         echo json_encode(
           array('message' => 'error occured')
         );
    }
  



