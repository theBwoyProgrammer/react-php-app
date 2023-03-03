<?php
   header('Access-Control-Allow-Origin: *');
   header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
   header('Access-Control-Allow-Headers: X-Requested-With');
   header('Content-Type: application/json');

// Include db.php file
include_once 'db.php';

// Create object of Products class
$product = new Database();

// create a api variable to get HTTP method dynamically
$api = $_SERVER['REQUEST_METHOD'];

// get id from url
$id = intval($_GET['id'] ?? '');

// Get all or a single product from database
if ($api == 'GET') {
		$data = $product->fetch();
        echo json_encode($data);
}

// Add a new product into the database
if ($api == 'POST') {
	$sku = $product->test_input($_POST['sku']);
	$name = $product->test_input($_POST['name']);
	$price = $product->test_input($_POST['price']);
    $type = $product->test_input($_POST['type']);
    $attributes = $product->test_input($_POST['attributes']);

	if ($product->insert($sku, $name, $price, $type, $attributes)) {
		echo $product->message('User added successfully!',false);
	} else {
		echo $product->message('Failed to add an user!',true);
	}
}

// Delete product(s) from database
if ($api == 'DELETE') {
	if (!empty($_POST['ids'])) {
		$ids = $_POST['ids'];
		if ($product->deleteMultiple($ids)) {
			echo $product->message('Product(s) deleted successfully!', false);
		} else {
			echo $product->message('Failed to delete product(s)!', true);
		}
	} else {
		echo $product->message('Product(s) not found!', true);
	}
}
