<?php

include "../dbcon.php";
include "../randomstring.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $type = $_POST['types'];
    $price = $_POST['price'];

    if (!is_dir('./img')) {
      mkdir('./img');
    }

    if (empty($errors)) {
        $image = $_FILES['image'];
        $imagePath = '';

        if ($image) {
            $imagePath = '../inventory/img/'.randomString(8, 1).'/'.$image['name'];
            mkdir(dirname($imagePath));
            move_uploaded_file($image['tmp_name'], $imagePath);
        }

        $statement = $pdo->prepare("INSERT INTO tbl_inventory (item_name, type, quantity, price, image)
        VALUES (:item_name, :type, :quantity, :price, :image)"
        );

        $statement->bindValue(':item_name', $name);
        $statement->bindValue(':type', $type);
        $statement->bindValue(':quantity', $quantity);
        $statement->bindValue(':price', $price);
        $statement->bindValue(':image', $imagePath);
        $statement->execute();  

        header("location:inventory.php");
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
        <li><a href="../order/order.php">Transactions</a></li>
        <li class="disabled" ><a href="../inventory/inventory.php">Inventory</a></li>
        <li><a href="../view_orders/viewitem.php">View Records</a></li>
        <li class="logout"><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="admin-contents">
      <div class="navbar">
        <li><a href="inventory.php">View Items</a></li>
        <li class="disabled"><a href="">Add Items</a></li>
        <li><a href="out_stock.php">Out of Stock</a></li>
      </div>
      <div class="tran-form">
        <form method="POST" action="" enctype="multipart/form-data">
        <div class="form-group">
            <label class="form-label">Product Img</label>
            <input
              type="file"
              class="form-control"
              name="image"
            />
        </div>
        <div class="form-group">
            <label for="">Items Name:</label>
            <input
              type="text"
              class="form-control"
              name="name"
              required
            />
        </div>
         <div class="form-group">
            <label for="">Types:</label>
            <select name="types">
              <option value="Parts">Parts</option>
              <option value="Bike">Bike</option>
            </select>
          </div>
          <div class="form-group">
            <label for="">Quantity:</label>
            <input
              type="number"
              class="form-control"
              name="quantity"
              required
            />
          </div>
          
          <div class="form-group">
            <label for="">Price:</label>
            <input
              type="number"
              class="form-control"
              name="price"
              required
            />
          </div>

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
