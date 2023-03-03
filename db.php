<?php
	// Include config.php file
	include_once 'config.php';

	// Create a class products
	class Database extends Config {
	  // Fetch all or a single user from database
	  public function fetch($id = 0) {
	    $sql = 'SELECT * FROM products';
	    if ($id != 0) {
	      $sql .= ' WHERE id = :id';
	    }
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['id' => $id]);
	    $rows = $stmt->fetchAll();
	    return $rows;
	  }

	  // Insert a product in the database
	  public function insert($sku, $name, $price, $type, $attributes) {
	    $sql = 'INSERT INTO products (sku, name, price, type, attributes) VALUES (:sku, :name, :price, :type, :attributes)';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['sku' => $sku, 'name' => $name, 'price' => $price, 'type' => $type, 'attributes' => $attributes]);
	    return true;
	  }

	  // Update a user in the database. NOTE: WE DON'T REALLY NEED THIS FOR OUR APP.
	  public function update($name, $email, $phone, $id) {
	    $sql = 'UPDATE users SET name = :name, email = :email, phone = :phone WHERE id = :id';
	    $stmt = $this->conn->prepare($sql);
	    $stmt->execute(['name' => $name, 'email' => $email, 'phone' => $phone, 'id' => $id]);
	    return true;
	  }

	  // Delete selected products from the database

      public function delete($ids) {
        $placeholders = rtrim(str_repeat('?,', count($ids)), ',');
        $sql = "DELETE FROM products WHERE id IN ($placeholders)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($ids);
        return true;
    }
    
	}

?>