<?php
	function addProduct($type,$name,$price,$image){
		require_once DATABASE_CONTROLLER;
		$query = "SELECT name, type FROM products WHERE name = :name AND type = :type";
		$params = [ ':name' => $name,
					':type' => $type
			 ];
		//Úgy gondoltam ugyan olyan nevű termék lehet, de ugyan olyan típusú és nevű egyszerre nem, mert pl. yuxin 3x3 és 4x4 is van stb..
		$record = getRecord($query, $params);
		if(empty($record)){
			$stmt = "INSERT INTO products(type,name,price,image) VALUES (:type, :name, :price, :image)";
			$params = [
				":type" => $type,
				":name" => $name,
				":price" => $price,
				":image" => $image
			];
			return executeDML($stmt,$params);
		}
		echo nl2br("There's already a product with the given name and type.\n");
		return false;
	}

	function delProduct($id){
		require_once DATABASE_CONTROLLER;
		$query = "DELETE FROM products WHERE id = :id";
		$params = [ ':id' => $id];
		return executeDML($query,$params);
	}

	function editProduct($id,$type,$name,$price,$image){
		require_once DATABASE_CONTROLLER;
		$query = "SELECT name, type FROM products WHERE name = :name AND type = :type AND NOT id = :id";
		$params = [ ':name' => $name,
					':type' => $type,
					':id' => $id
			 	];

		$record = getRecord($query, $params);

		if(empty($record)){
			$stmt = "UPDATE products SET name = :name, type = :type, price = :price, image = :image WHERE id = :id";
			$params = [ ':name' => $name,
					':type' => $type,
					':price' => $price,
					':id' => $id,
					':image' => $image
			 ];
			return executeDML($stmt,$params);
		}
		echo nl2br("There's already a product with the given name and type.\n");
		return false;
	}
?>
