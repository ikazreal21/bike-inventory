<?php

include "../dbcon.php";
include "../validation.php";

$total_amount = 0;
$total_quantity = 0;
$itemArr = [];


$statement = $pdo->prepare('SELECT * FROM tbl_orderconfirm order by cart_id desc');
$statement->execute();
$row = $statement->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($_SERVER['REQUEST_METHOD']);
// echo '<pre>';

foreach ($row as $i => $products) {
    $total_quantity += $products['quantity'];
    $total_amount += $products['quantity'] * $products['amount'];

    // array_push($itemArr, $item_detail);
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
        <?php if ($_SESSION["Roles"] == 'admin'): ?>
        <li><a href="../add_type/type.php">View Type</a></li>
        <li><a href="../add_brand/brand.php">View Brand</a></li>
        <?php endif;?>
        <li class="logout"><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="admin-contents">
        <div class="navbar">
            <li><a href="order.php">Order</a></li>
            <li><a href="order_confirm.php">Confirm Order</a></li>
            <li><a class="disabled" href="#">Order Summary</a></li>
        </div>
        <div class="admin-tables">
            <form method="POST" action="checkout_order.php">
                <h1>Order Summary</h1>
                <?php foreach ($row as $i => $item): ?>
                    <div style="display: flex; justify-content: space-between;">
                        <p style="background-color: papayawhip;"><?php echo $item['item_name']; ?></p>
                        <p style="background-color: palegoldenrod;">x<?php echo $item['quantity']; ?></p>
                        <p style="background-color: palegoldenrod;">Amount: ₱ <?php echo number_format($item['amount'],  2, '.', ','); ?></p>
                    </div>
                    <?php endforeach;?>
                    <h5>Total Quantity:  &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; <?php echo $total_quantity; ?></h5>
                    <h5>Total Amount: &emsp; &emsp; &emsp; &emsp; &emsp; &emsp; &emsp;₱ <?php echo number_format($total_amount,  2, '.', ','); ?></h5>
                    <button type="submit" class="btn">Process Order</button>
            </form>
        </div>
    </div>
  </body>
</html>
