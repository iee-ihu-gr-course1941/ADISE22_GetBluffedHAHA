<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/GameTable.php';

    // instantiate database
    $db = new Database;
    $db = $db->connect();

    // Instantiate GameTable model
    $gameTable = new GameTable($db);

    $gameTable->initializeCards();