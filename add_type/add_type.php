<?php

include "../dbcon.php";
include "../validation.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type = $_POST['type'];

    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO tbl_itemtype (item_type) VALUES (:item_type)"
        );

        $statement->bindValue(':item_type', $type);
        $statement->execute();  

        header("location:type.php");
    }
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
        <li><a href="../order/order.php">Transactions</a></li>
        <li><a href="../inventory/inventory.php">Inventory</a></li>
        <li><a href="../view_orders/viewitem.php">View Records</a></li>
        <?php if ($_SESSION["Roles"] == 'admin'): ?>
        <li class="disabled" ><a href="../add_type/type.php">View Type</a></li>
        <li><a href="../add_brand/brand.php">View Brand</a></li>
        <?php endif;?>
        <li class="logout"><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="admin-contents">
      <div class="navbar">
        <li><a href="type.php">View Types</a></li>
        <li class="disabled"><a href="">Add Type</a></li>
      </div>
      <div class="add-form">
        <form method="POST" action="" enctype="multipart/form-data">
            <label class="form-label">Type:</label>
            <input
              type="text"
              class="form-control"
              name="type"
              required
            />
        <div class="buttons-form">
            <input type="submit" class="btn" value="Add Item" />
            <!-- <input type="submit" class="btn" value="Delete Item" /> -->
            <input type="reset" class="btn" value="Cancel" />
        </div>
        </form>
      </div>
    </div>
  </body>
</html>
