<?php

include 'db.php';
header("Content-Type:application/json");
$newDatabase = new Database();

$newDatabase->delete($_POST['id']);

$data = [
    'data' => [],
    "message" => "Successfully deleted"
];