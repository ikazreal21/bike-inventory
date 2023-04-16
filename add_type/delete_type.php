<?php

include "../dbcon.php";
include "../validation.php";




$id = $_POST['id'] ?? null;

if (!$id) {
	header('Location: type.php');
	exit;
}


$statement = $pdo->prepare('DELETE FROM tbl_itemtype where itemtype_id = :id');
$statement->bindValue(':id', $id);
$statement->execute();


header('Location: type.php');

?>