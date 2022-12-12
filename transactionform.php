<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method=POST action=transactionform.php>

<table border=5>
<tr>
<th colspan=3>ORDER</th>
<tr>
<td>ITEM TYPE:
<td>
<select name=itemtype>
<option value=itemtypes>--------------------------------
<option value=bike>BIKE
<option value=parts>PARTS
</select>
<tr>
<td>ITEM NAME:
<td>
<select name=itemname>
<option value=itemnames>--------------------------------
<option value=shimano>Shimano
<option value=bmx>BMX
<tr>
<td>QUANTITY:
<td>
<input type="number" name="Quantity" value="1" min="1" max="10">
<tr>
<tr>
<th colspan=2>
	<input type=submit name=add value="ADD ITEM">
	<input type=submit name=cancel value="CANCEL">


</form>
</body>
</html>
<center>
<?php

$servername="localhost";
$username="root";
$password="";
$dbase="db_order"; 

$conn=new mysqli($servername,$username,$password,$dbase);

if(!$conn->connect_error)
{
echo "<tr>";
echo "<tr> <center>Connected</center>";
}

if(isset($_POST['add']))
{

		
$itemtype=$_POST['itemtype'];
$itemname=$_POST['itemname'];
$Quantity=$_POST['Quantity'];


$sql = "INSERT INTO transaction_form (ITEM_TYPE, ITEM_NAME, ORDER_QUANTITY) VALUES ('$itemtype','$itemname','$Quantity')";

$insert = $conn->query($sql);

if($insert == TRUE)
{
?>
<script>
	alert("Successfully Added")
</script>
<?php
}
else
{
	echo $conn->error;
}

$conn->close();
}
?>
</center>

