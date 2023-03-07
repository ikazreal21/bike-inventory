<?php

include "../dbcon.php";
include "../validation.php";

$search = $_GET['search'] ?? '';

if ($search) {
    $statement = $pdo->prepare('SELECT * FROM order_form where ITEM_NAME like :INAME ORDER BY ID desc');
    $statement->bindValue(':INAME', "%$search%");
} else {
    $statement = $pdo->prepare('SELECT * FROM order_form ORDER BY ID desc');
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
            <th>Date Purchased</th>
            <th>Item Name</th>
            <th>Item Type</th>
            <th>Quantity</th>
            <th>Amount</th>
        </tr>
		  <?php foreach ($row as $i => $item):?>
        <tr>
			<td><?php echo $item['ID']; ?></td>
			<td><?php echo $item['ORDER_DATE']; ?></td>
			<td><?php echo $item['ITEM_TYPE']; ?></td>
			<td><?php echo $item['ITEM_NAME']; ?></td>
			<td><?php echo $item['ORDER_QUANTITY']; ?></td>
			<td><?php echo $item['amount']; ?></td>
        </tr>
        <?php endforeach;?>	
        </table>
      </div>
    </div>
  </body>
</html>
