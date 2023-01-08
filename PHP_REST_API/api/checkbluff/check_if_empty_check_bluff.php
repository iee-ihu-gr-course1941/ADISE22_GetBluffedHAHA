<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Authorization,X-Token');

include_once '../../config/Database.php';
include_once '../../models/CheckBluff.php';

// instantiate database
$db = new Database;
$db = $db->connect();

// Instantiate CheckBluff model
$checkBluff = new CheckBluff($db);

 //checkbluff query
 $result = $checkBluff->checkIfCheckBluffIsEmpty();

 //get row count
 $rowcount = $result->rowCount();

 if($rowcount > 0) {
    $check_bluff_arr = array();
    $check_bluff_arr['data'] = array();

    while($row =$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $check_bluff_item = array(
            'id' => $id,
            'card_id' => $player_id,
            'player_id' => $card_id,
            'last_changed' => $last_changed 

        );
        array_push($check_bluff_arr['data'], $check_bluff_item);


    }
    echo json_encode($check_bluff_arr);
 }else{
    echo json_encode(
        array('message' => 'no table found'));
 }

    
     /*   //check table
   if($rowcount != null) {
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
            array('message' => 'failed to check if checkBluff is empty'));
     } 

    //check table
    if($checkBluff->checkIfCheckBluffIsEmpty()){

        echo json_encode(
            array('message' =>'checked if checkBluff is empty')
        );
    }else{
        echo json_encode(
            array('message' =>'failed to check if checkBluff is empty')
        );
    }

    //get raw posted data
   // $data = json_decode(file_get_contents("php://input"));

    //checkbluff query
  /*  $result = mysqli_query($data, $query);
    $result = $checkBluff->checkIfCheckBluffIsEmpty();
    
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC); 

    
    if(! $row) {

        echo json_encode(
            array('message' =>'checked if checkBluff is empty')
        );

       // echo "<p></p>";
    } else {

        echo json_encode(
            array('message' =>'failed to check if checkBluff is empty')
        );

       // echo '<p>' . $row['description'] . '</p>';
    } */




