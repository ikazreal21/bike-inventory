<?php  

include "../dbcon.php";
include "../validation.php";


$statement = $pdo->prepare('SELECT * FROM tbl_brand order by brand_id desc');
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
        <li><a href="../add_type/type.php">View Type</a></li>
        <li class="disabled" ><a href="">View Brand</a></li>
        <?php endif;?>
        <li class="logout"><a href="../logout.php">Logout</a></li>
      </ul>
    </div>
    <div class="admin-contents">
      <div class="navbar">
        <li class="disabled"><a href="">View Brand</a></li>
        <li><a href="add_brand.php">Add Brand</a></li>
      </div>
      <div class="admin-tables">
        <table class="inventory">
        <tr>
            <th>Brand ID</th>
            <th>Brand</th>
            <?php if ($_SESSION["Roles"] == 'admin'): ?>
            <th>Action</th>
            <?php endif;?>
        </tr>
          <?php foreach ($row as $i => $item):?>
        <tr>
			<td><?php echo $item['brand_id']; ?></td>
			<td><?php echo $item['brand_name']; ?></td>
      <?php if ($_SESSION["Roles"] == 'admin'): ?>
      <td>
        <form method="POST" action="delete_brand.php">
         <input type="hidden" name="id" value="<?php echo $item['brand_id']; ?>">
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
