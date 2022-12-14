<?php

include "../dbcon.php";

$statement = $pdo->prepare('SELECT * FROM tbl_inventory where quantity >= 2');
$statement->execute();
$inventory = $statement->fetchAll(PDO::FETCH_ASSOC);


// echo '<pre>';
// var_dump($inventory);
// echo '<pre>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['items'];
    $quantity = $_POST['quantity'];
    $orderdate = date("Y-m-d");
    $existingquantity = '';
    $newquantity = '';

    $statement = $pdo->prepare('SELECT * FROM tbl_inventory WHERE item_id = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    $selected_prod = $statement->fetch(PDO::FETCH_ASSOC);
    $existingquantity = $selected_prod['quantity'];
    $item_name = $selected_prod['item_name'];
    $item_type = $selected_prod['type'];
    $item_price = $quantity * $selected_prod['price'];

    if ($quantity < $existingquantity) {
        $newquantity = $existingquantity - $quantity;
        $statement = $pdo->prepare("UPDATE tbl_inventory set quantity = :IQUAN WHERE item_id = :id");
        $statement->bindValue(':IQUAN', $newquantity);
        $statement->bindValue(':id', $id);
        $statement->execute();
    }
    echo $errors;
    
    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO order_form (ORDER_DATE, ITEM_TYPE, ITEM_NAME, description, ORDER_QUANTITY, amount)
        VALUES (:ORDER_DATE, :ITEM_TYPE, :ITEM_NAME, :description, :ORDER_QUANTITY, :amount)"
        );

        $statement->bindValue(':ORDER_DATE', $orderdate);
        $statement->bindValue(':ITEM_TYPE', $item_type);
        $statement->bindValue(':ITEM_NAME', $item_name);
        $statement->bindValue(':description', '');
        $statement->bindValue(':ORDER_QUANTITY', $quantity);
        $statement->bindValue(':amount', $item_price);
        $statement->execute();

        header("location:order.php");
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
    <title>Bicycle King | Admin</title>
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
        <h4>Welcome to Admin!</h4>
      </div>
      <ul>
        <li class="disabled"><a href="order.php">Transactions</a></li>
        <li><a href="../inventory/inventory.php">Inventory</a></li>
        <li><a href="../view_orders/viewitem.php">View Records</a></li>
        <li class="logout"><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="admin-contents">
      <div class="navbar">
        <li><a class="disabled" href="order.php">Order</a></li>
        <li><a href="order_confirm.php">Confirm Order</a></li>
        <li><a href="#">Order Summary</a></li>
        <li><a href="#">Reciept</a></li>
      </div>
      <div class="tran-form-card">
        <?php foreach ($inventory as $i => $item): ?>
        <div class="flex-wrapper">
          <form method="POST" action="" class="form-card" >
            <div class="card">
              <img src="<?php echo $item['image']; ?>" alt="item image" style="width:100%;">
              <div class="container">
                <h4><b><?php echo $item['item_name']; ?></b></h4>
                <p><?php echo $item['type']; ?></p>
                <input type="text" name="items" value="<?php echo $item['item_id']; ?>" hidden/>
                <input type="number" class="form-control" name="quantity" placeholder="Quantity" required />
                <input type="submit" class="btn" value="Add Order" />
              </div>
            </div>
            <!-- <div class="buttons-form"> -->
              <!-- <input type="submit" class="btn" value="Delete Item" /> -->
              <!-- <input type="reset" class="btn" value="Cancel" /> -->
              <!-- </div> -->
          </form>
        </div>
        <?php endforeach;?>
      </div>
    </div>
  </body>
</html>
