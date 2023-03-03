<?php
	// Include config.php file
	include_once 'config.php';

	// Create a class products
	class Database extends Config {

	  // Fetch all products from database
	  public function fetch($id = 0) {
	    $sql = 'SELECT * FROM products';
	    
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

        // Update a product in the database
        public function update($sku, $name, $price, $type, $attributes, $id) {
            $sql = 'UPDATE products SET sku = :sku, name = :name, price = :price, type = :type, attributes = :attributes WHERE id = :id';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['sku' => $sku, 'name' => $name, 'price' => $price, 'type' => $type, 'attributes' => $attributes, 'id' => $id]);
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