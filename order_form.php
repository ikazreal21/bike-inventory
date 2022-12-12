<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<form method=POST action=order_form.php>

<table border=5>
<tr>
<th colspan=3>ORDER</th>
<tr>
<td>DATE:
<td>
<input type=date name=orderdate class="form-control">
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
<td>ITEM DESCRIPTION:
<td>
	<input type=text name=desc value="description">
<tr>
<td>QUANTITY:
<td>
<input type="number" name="Quantity" value="1" min="1" max="10">
<tr>
<tr>
<th colspan=2>
	<input type=submit name=add value="ADD ITEM">
	<a href="View.php"><input type=submit name=cancel value="CANCEL"></a>


</form>
</body>
</html>
<center>
<?php

include "dbcon.php";

if (!$conn->connect_error) {
    echo "<tr>";
    echo "<tr> <center>Connected</center>";
}

if (isset($_POST['add'])) {

    $orderdate = $_POST['orderdate'];
    $itemtype = $_POST['itemtype'];
    $itemname = $_POST['itemname'];
    $desc = $_POST['desc'];
    $Quantity = $_POST['Quantity'];

    $sql = "INSERT INTO order_form (ORDER_DATE, ITEM_TYPE, ITEM_NAME,description, ORDER_QUANTITY) VALUES ('$orderdate','$itemtype','$itemname','$desc','$Quantity')";

    $insert = $conn->query($sql);

    $alert = "<script>alert('Successfully Added');</script>";

    if ($insert == true) {
        header('Location: View.php');
        exit();
    } else {
        echo $conn->error;
    }

    $conn->close();
}
?>
</center>

