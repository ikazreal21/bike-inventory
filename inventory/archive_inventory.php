<?php

include "../dbcon.php";
include "../validation.php";




$id = $_POST['id'] ?? null;

if (!$id) {
	header('Location: inventory.php');
	exit;
}


$statement = $pdo->prepare('UPDATE tbl_inventory set status = "archive" where item_id = :id');
$statement->bindValue(':id', $id);
$statement->execute();


header('Location: inventory.php');

?>