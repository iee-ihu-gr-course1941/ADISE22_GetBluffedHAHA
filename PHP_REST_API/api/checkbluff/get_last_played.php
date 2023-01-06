<?php
 header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

include_once '../../config/Database.php';
include_once '../../models/CheckBluff.php';

// instantiate database
$db = new Database;
$db = $db->connect();

// Instantiate player model
$checkbluff = new CheckBluff($db);

$checkbluff->get_last_play();