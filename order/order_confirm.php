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
        <li class="disabled"><a href="transact.php">Transactions</a></li>
        <li><a href="">Inventory</a></li>
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
      <div class="tran-form">
      </div>
    </div>
  </body>
</html>
