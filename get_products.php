<?php
header("Content-Type:application/json");
include 'db.php';

$newDatabase = new Database();

$data = [
    'data' => $newDatabase->fetch(),
    "message" => "Successfully"
];

print_r (json_encode($data));

?>