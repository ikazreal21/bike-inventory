<?php

include "../dbcon.php";
include "../validation.php";




$id = $_POST['id'] ?? null;

if (!$id) {
	header('Location: inventory.php');
	exit;
}


$statement = $pdo->prepare('DELETE FROM tbl_inventory where item_id = :id');
$statement->bindValue(':id', $id);
$statement->execute();


header('Location: inventory.php');

?>