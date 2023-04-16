<?php

include "../dbcon.php";
include "../validation.php";




$id = $_POST['id'] ?? null;

if (!$id) {
	header('Location: brand.php');
	exit;
}


$statement = $pdo->prepare('DELETE FROM tbl_brand where brand_id = :id');
$statement->bindValue(':id', $id);
$statement->execute();


header('Location: brand.php');

?>