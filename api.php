<?php
 $con = mysqli_connect("localhost","root","adminalex","testdbforphp");
 header('Access-Control-Allow-Origin: *');  
 $response = array();
 if($con){
    $sql = "SELECT * FROM testtable";
    $result = mysqli_query($con,$sql);
    if($result){
        header("Content-Type: JSON");
        
        $i=0;
        while($row = mysqli_fetch_assoc($result)){
            $response[$i]['id'] = $row['id'];
            $response[$i]['type'] = $row['type'];
            $response[$i]['number'] = $row['number'];
            $response[$i]['user'] = $row['user'];
            $i++;
        }
        echo json_encode($response,JSON_PRETTY_PRINT);
    }
 }else{
    echo "db connection failed";
 }
?>