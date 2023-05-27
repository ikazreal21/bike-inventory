<?php 
    include "../dbcon.php";
    include "../validation.php";

    $id = $_GET['id'] ?? null;


    $statement = $pdo->prepare('SELECT * FROM tbl_orders where serial_number = :id');
    $statement->bindValue(':id', $id);
    $statement->execute();
    $row = $statement->fetchAll(PDO::FETCH_ASSOC);
    $row = $row[0];

    // echo '<pre>';
    // var_dump($row);
    // echo '<pre>';

    $orderArr = json_decode($row['inventory_ids']);
    $prodDetial = [];

    foreach ($orderArr as $i => $item) {
    $statement = $pdo->prepare('SELECT * FROM tbl_inventory WHERE item_id = :id');
    $statement->bindValue(':id', $item);
    $statement->execute();
    $productdetail = $statement->fetch(PDO::FETCH_ASSOC);

    $prodDetial[] = $productdetail;
  }
    
    echo "<script>window.print();</script>";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Receipt</title>
</head>
<body>
    <center>
    <h1>Order Date: <?php echo $row['order_date']; ?></h1>
    <h1>Total Quantity: <?php echo $row['total_quantity']; ?></h1>
    <h1>Total Quantity: ₱<?php echo number_format($row['total_amount'],  2, '.', ','); ?></h1>
    <h1>Serial Number: ₱<?php echo $row['serial_number'];; ?></h1>
    <table class="inventory">
            <tr>
                <th>Item Code</th>
                <th>Name of Item</th>
                <th>Type</th>
                <th>Brand</th>
                <th>Quantity</th>
                <th>Description</th>
                <th>Price</th>
            </tr>
            <?php foreach ($prodDetial as $i => $item):?>
            <tr>
                <td><?php echo $item['item_id']; ?></td>
                <td><?php echo $item['item_name']; ?></td>
                <td><?php echo $item['type']; ?></td>
                <td><?php echo $item['brand']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
                <td><?php echo $item['description']; ?></td>
                <td>₱ <?php echo number_format($item['price'],  2, '.', ','); ?></td>  
            </tr>
            <?php endforeach;?>
    </table>
    </center>
</body>
</html>