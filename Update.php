<?php

	include "dbcon.php";
$rn =$_GET['rn'];
$od =$_GET['od'];
$it =$_GET['it'];
$in =$_GET['in'];
$dc =$_GET['dc'];
$oq =$_GET['oq'];

?>

<html>
<head>
	<title></title>
</head>
<body>
<form method=GET action="View.php">
	<table border=5>
<tr>
<th colspan=3>ORDER</th>
<tr>
<td>DATE:
<td>
<input type=date name=orderdate class="form-control" value = "<?php echo "$od" ?>">
<tr>
<td>ITEM TYPE:
<td>
<select name=itemtype>
<option value="<?php echo "$it" ?>"
<option value=bike>BIKE
<option value=parts>PARTS
</select>
<tr>
<td>ITEM NAME:
<td>
<input type="text" name="itname" value="<?php echo "$in" ?>">
<tr>
<tr>
<td>ITEM DESCRIPTION:
<td>
	<input type=text name=desc value="<?php echo "$dc" ?>">
<tr>
<td>QUANTITY:
<td>
<input type="number" name="Quantity" value="<?php echo "$oq" ?>" min="1" max="100">
<tr>
<tr>
<th colspan=2>
	<input type=submit name=add value="EDIT ITEM">
	<input type=submit name=cancel value="CANCEL">


</form>
</body>
</html>

<?php

if(isset($_POST['add']))
{

$rn =$_GET['rn'];
$od =$_GET['od'];
$it =$_GET['it'];
$in =$_GET['in'];
$dc =$_GET['dc'];
$oq =$_GET['oq'];

$sql = "UPDATE order_form set ORDER_DATE = '$_POST[orderdate]', ITEM_TYPE = '$_POST[itemtype]', ITEM_NAME = '$in',description ='$dc', ORDER_QUANTITY = 'oq' WHERE ID = '$rn'";

$insert = $conn->query($sql);

$alert = "<script>alert('Successfully Added');</script>";

if($insert == TRUE)
{
header('Location: View.php');
exit();
}
else
{
	echo $conn->error;
}

$conn->close();
}
?>