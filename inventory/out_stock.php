<?php  

include "../dbcon.php";
include "../validation.php";


$search = $_GET['type'] ?? '';

$statement = $pdo->prepare('SELECT * FROM tbl_itemtype order by itemtype_id desc');
$statement->execute();
$types = $statement->fetchAll(PDO::FETCH_ASSOC);

if ($search) {
  $statement = $pdo->prepare('SELECT * FROM tbl_inventory where type like :INAME and quantity = 0  status = "active" order by item_id desc');
  $statement->bindValue(':INAME', "%$search%");
} else {
  $statement = $pdo->prepare('SELECT * FROM tbl_inventory where quantity = 0 and status = "active" order by item_id desc');
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
        <li class="disabled" ><a href="inventory.php">Inventory</a></li>
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
        <li><a href="inventory.php">View Items</a></li>
        <?php if ($_SESSION["Roles"] == 'admin'): ?>
        <li><a href="add_inventory.php">Add Items</a></li>
        <?php endif;?>
        <li class="disabled"><a href="#contact">Out of Stock</a></li>
        <li><a href="archive_items.php">Archive Items</a></li>
      </div>
      <div class="admin-tables">
        <div class="admin-select">
          <form method="get" action="">
          <select name="type">
            <option selected value="">Select Type</option>
            <?php foreach ($types as $i => $item):?>
              <option value="<?php echo $item['item_type']; ?>"><?php echo $item['item_type']; ?></option>
              <?php endforeach;?>
            </select>
            <input type="submit" value="Submit" />
          </form>
        </div>

        <table class="inventory">
        <tr>
            <th>Item Code</th>
            <th>Name of Item</th>
            <th>Type</th>
            <th>Brand</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Stock Status</th>
            <th>Action</th>
        </tr>
          <?php foreach ($row as $i => $item):?>
        <tr>
			<td><?php echo $item['item_id']; ?></td>
			<td><?php echo $item['item_name']; ?></td>
			<td><?php echo $item['type']; ?></td>
			<td><?php echo $item['brand']; ?></td>
			<td><?php echo $item['quantity']; ?></td>
			<td>₱ <?php echo number_format($item['price'],  2, '.', ','); ?></td>
			<td style="color:red;">Out on Stock</td>
      <td><a href="update_inventory.php?id=<?php echo $item['item_id']; ?>">Edit</a></td>
      </tr>
        <?php endforeach;?>
        
        </table>
      </div>
    </div>
  </body>
</html>
