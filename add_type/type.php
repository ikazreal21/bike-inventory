<?php  

include "../dbcon.php";
include "../validation.php";


$statement = $pdo->prepare('SELECT * FROM tbl_itemtype order by itemtype_id desc');
$statement->execute();
$row = $statement->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($date);
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
        <li><a href="../view_orders/viewitem.php">View Records</a></li>
        <?php if ($_SESSION["Roles"] == 'admin'): ?>
        <li  class="disabled" ><a href="../add_type/type.php">View Type</a></li>
        <li><a href="../add_brand/brand.php">View Brand</a></li>
        <?php endif;?>
        <li class="logout"><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="admin-contents">
      <div class="navbar">
        <li class="disabled"><a href="">View Type</a></li>
        <li><a href="add_type.php">Add Type</a></li>
      </div>
      <div class="admin-tables">
        <table class="inventory">
        <tr>
            <th>Item Type ID</th>
            <th>Item Type</th>
            <?php if ($_SESSION["Roles"] == 'admin'): ?>
            <th>Action</th>
            <?php endif;?>
        </tr>
          <?php foreach ($row as $i => $item):?>
        <tr>
			<td><?php echo $item['itemtype_id']; ?></td>
			<td><?php echo $item['item_type']; ?></td>
      <?php if ($_SESSION["Roles"] == 'admin'): ?>
      <td>
        <form method="POST" action="delete_type.php">
         <input type="hidden" name="id" value="<?php echo $item['itemtype_id']; ?>">
         <button type="submit">Delete</button>
        </form>
      </td>
      <?php endif;?>
      </tr>
        <?php endforeach;?>
        </table>
      </div>
    </div>
  </body>
</html>
