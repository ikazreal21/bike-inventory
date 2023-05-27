<?php

include "../dbcon.php";
include "../validation.php";
include "../randomstring.php";

$total_amount = 0;
$total_quantity = 0;
$itemArr = [];


$statement = $pdo->prepare('SELECT * FROM tbl_orderconfirm order by cart_id desc');
$statement->execute();
$row = $statement->fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>';
// var_dump($_SERVER['REQUEST_METHOD']);
// echo '<pre>';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 

    
    
    foreach ($row as $i => $products) {
        $total_quantity += $products['quantity'];
        $total_amount += $products['quantity'] * $products['amount'];
        array_push($itemArr, $products['item_id']);


        $statement = $pdo->prepare('DELETE FROM tbl_orderconfirm WHERE cart_id = :id');
        $statement->bindValue(':id', $products['cart_id']);
        $statement->execute();
    }

    $itemArrs = json_encode($itemArr);
    $orderdate = date("Y-m-d");
    $serial = randomString(8, 2);

    if (empty($errors)) {
        $statement = $pdo->prepare("INSERT INTO tbl_orders (order_date, total_quantity, total_amount, inventory_ids, serial_number)
          VALUES (:order_date, :total_quantity, :total_amount, :inventory_ids, :serial_number)"
        );

        $statement->bindValue(':order_date', $orderdate);
        $statement->bindValue(':total_quantity', $total_quantity);
        $statement->bindValue(':total_amount', $total_amount);
        $statement->bindValue(':inventory_ids', $itemArrs);
        $statement->bindValue(':serial_number', $serial);
        $statement->execute();
        $item_detail = $statement->fetch(PDO::FETCH_ASSOC);

        echo "<script>window.open('printReceipt.php?id=$serial', '_Details', 'width=750, height=750, scrollbars=1, resizable=1'); alert('Printing Reciept'); window.location = 'order.php'; </script>";
        exit;
    }

}

?>