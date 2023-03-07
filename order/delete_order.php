<?php

include "../dbcon.php";
include "../validation.php";



$id = $_POST['id'] ?? null;

// echo '<pre>';
// var_dump($id);
// echo '<pre>';

if (!$id) {
	// echo '<pre>';
	// var_dump($id);
	// echo '<pre>';
	header('Location: order_confirm.php');
	exit;
}


$statement = $pdo->prepare('SELECT * FROM tbl_orderconfirm WHERE cart_id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
$prod2 = $statement->fetch(PDO::FETCH_ASSOC);
$quantity2 = $prod2["quantity"];
$product_id = $prod2["item_id"];


$statement = $pdo->prepare('SELECT * FROM tbl_inventory WHERE item_id = :id');
$statement->bindValue(':id', $product_id);
$statement->execute();
$prod = $statement->fetch(PDO::FETCH_ASSOC);
$quantity = $prod["quantity"];

$updatequantity = '';
$updatequantity = $quantity2 + $quantity;


$statement = $pdo->prepare('UPDATE tbl_inventory set quantity = :quantity WHERE item_id = :id');
$statement->bindValue(':quantity', $updatequantity);
$statement->bindValue(':id', $product_id);
$statement->execute();


$statement = $pdo->prepare('DELETE FROM tbl_orderconfirm where cart_id = :id');
$statement->bindValue(':id', $id);
$statement->execute();


header('Location: order_confirm.php');

?>