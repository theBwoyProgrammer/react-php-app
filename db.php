<?php
	// Include config.php file
	include_once 'config.php';

	// Create a class Users
    class Database extends Config {

      public function fetch() {
        $sql = 'SELECT * FROM products';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        $productList = array();
 
        while($row=$stmt->fetch(PDO::FETCH_ASSOC)){
            $productList['products'][] = $row;	
        }
        return $productList;
    }
    

	  // Insert an user in the database
	  public function insert($sku, $name, $price, $type, $attribute_name, $attribute_value) {
	    $sql = 'INSERT INTO products (sku, name, price, type, attribute_name, attribute_value) VALUES (:sku, :name, :price, :type, :attribute_name, :attribute_value)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['sku' => $sku, 'name' => $name, 'price' => $price, 'type' => $type, 'attribute_name' => $attribute_name, 'attribute_value' => $attribute_value]);
	    // return the inserted value
        return $this->conn->lastInsertId();
	  }

	 // Delete an user from database
   public function delete($id) {
    $sql = 'DELETE FROM products WHERE id =:id';
    $stmt = $this->conn->prepare($sql);
    $stmt->execute(['id' => $id]);
    return true;
  }
}

