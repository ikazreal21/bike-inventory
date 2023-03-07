<?php

include "../dbcon.php";
include "../validation.php";

$total_amount = 0;
$total_quantity = 0;


$statement = $pdo->prepare('SELECT * FROM tbl_orderconfirm order by cart_id desc');
$statement->execute();
$row = $statement->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($row);
// echo '<pre>';

foreach ($row as $i => $products) {
  $total_quantity += $products['quantity'];
  $total_amount += $products['quantity'] * $products['amount'];
}

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
        <li class="disabled"><a href="transact.php">Transactions</a></li>
        <li><a href="../inventory/inventory.php">Inventory</a></li>
        <li><a href="../view_orders/viewitem.php">View Records</a></li>
        <li class="logout"><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="admin-contents">
      <div class="navbar">
        <li><a href="order.php">Order</a></li>
        <li><a class="disabled" href="#">Confirm Order</a></li>
        <li><a href="#">Order Summary</a></li>
        <li><a href="#">Reciept</a></li>
      </div>
      <div class="admin-tables">
        <!-- <form method="POST" action="" enctype="multipart/form-data"> -->
        <table class="inventory">
        <tr>
            <th>Item Id</th>
            <th>Item Image</th>
            <th>Name of Item</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Action</th>
        </tr>
          <?php foreach ($row as $i => $item): ?>
            
        <tr>
          <td><?php echo $item['item_id']; ?></td>
          <td>
          <img src="<?php echo $item['item_image']; ?>"  width="200" height="100">
          </td>
          <td><?php echo $item['item_name']; ?></td>
          <td><?php echo $item['item_type']; ?></td>
          <td><input
              type="number"
              class="form-control"
              name="quantity"
              required
              value="<?php echo $item['quantity']; ?>"/>
          </td>
          <td><?php echo $item['amount']; ?></td>
          <td>
            <form method="POST" action="delete_order.php">
              <input type="hidden" name="id" value="<?php echo $item['cart_id']; ?>">
              <button type="submit">DELETE</button>
            </form>
          </td>
        </tr>
        <?php endforeach;?>
        <tr>
            <th>Total Quantity</th>
            <th><?php echo $total_quantity; ?></th>
            <th></th>
            <th></th>
            <th>Total:</th>
            <th><?php echo $total_amount; ?></th>
            <!-- <th><button type="submit">Proceed</button></th> -->
        </tr>
        </table>
        <!-- </form> -->
      </div>
    </div>
  </body>
</html>
