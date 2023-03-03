<?php

include 'db.php';
header("Content-Type:application/json");
$newDatabase = new Database();

if (empty( $_POST['name']) || empty($_POST['sku'] )) {
    $data = [
        'data' => [],
        "message" => "Please fill all the fields"
    ];
    print_r (json_encode($data));
    die();
}

$productName = $_POST['name'];
$sku = $_POST['sku'];
$price = $_POST['price'];
$type = $_POST['type'];
$attributeName = $_POST['attribute_name'];
$attributeValue = $_POST['attribute_value'];

// insert in db
$response = $newDatabase->insert($sku, $productName, $price, $type, $attributeName, $attributeValue);
//return a successful response
$data = [
    'data' => $response,
    "message" => "Successfully"
];

?>