<?php

include "../dbcon.php";
include "../validation.php";

$search = $_GET['search'] ?? '';

if ($search) {
    $statement = $pdo->prepare('SELECT * FROM tbl_orders where serial_number like :INAME ORDER BY order_id desc');
    $statement->bindValue(':INAME', "%$search%");
} else {
    $statement = $pdo->prepare('SELECT * FROM tbl_orders ORDER BY order_id desc');
}

$statement->execute();
$row = $statement->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($row);
// echo '<pre>';

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/index.css" />
    <?php if ($_SESSION["Roles"] == 'admin'): ?>
    <title>Bicycle King | Admin</title>
    <?php else: ?>
    <title>Bicycle King | Cashier</title>
    <?php endif;?>
  </head>
  <body>
    <div class="admin-main">
      <div class="admin-image">
        <img
          src="../images/logoo.png"
          alt="admin logo"
          width="120"
          height="100"
        />
        <?php if ($_SESSION["Roles"] == 'admin'): ?>
          <h4>Welcome to Admin!</h4>
        <?php else: ?>
          <h4>Welcome to Cashier!</h4>
        <?php endif;?>
      </div>
      <ul>
        <li><a href="../order/order.php">Transactions</a></li>
        <li><a href="../inventory/inventory.php">Inventory</a></li>
        <li class="disabled" ><a href="">View Records</a></li>
        <?php if ($_SESSION["Roles"] == 'admin'): ?>
        <li><a href="../add_type/type.php">View Type</a></li>
        <li><a href="../add_brand/brand.php">View Brand</a></li>
        <?php endif;?>
        <li class="logout"><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="admin-contents">
      <div class="navbar">
        <!-- <li><a href="#home">Home</a></li>
        <li><a href="#news">News</a></li>
        <li><a href="#contact">Contact</a></li> -->

      </div>
      <div class="admin-tables">
        <div class="admin-select">
          <form action="" method="get">
		  	<input type="text" 
			class="form-control" 
			name="search" 
			placeholder="Enter Search" 
			value="<?php echo $search; ?>">
            <input type="submit" value="Submit" />
          </form>
        </div>

        <table class="inventory">
        <tr>
            <th>Item No.</th>
            <th>Transaction Number</th>
            <th>Date Purchased</th>
            <th>Total Quantity</th>
            <th>Total Amount</th>
            <th>Inventory Id's</th>
            <th>Actions</th>
        </tr>
		  <?php foreach ($row as $i => $item):?>
        <tr>
			<td><?php echo $item['order_id']; ?></td>
			<td><?php echo $item['serial_number']; ?></td>
			<td><?php echo $item['order_date']; ?></td>
			<td><?php echo $item['total_quantity']; ?></td>
			<td>₱ <?php echo number_format($item['total_amount'],  2, '.', ','); ?></td>
			<td><?php echo $item['inventory_ids']; ?></td>
			<td><a  onclick="window.open(this.href); return false" href="../order/printReceipt.php?id=<?php echo $item['serial_number']; ?>">Print</a></td>
        </tr>
        <?php endforeach;?>	
        </table>
      </div>
    </div>
  </body>
</html>
