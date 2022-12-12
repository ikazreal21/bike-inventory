<?php
session_start();
include "dbcon.php";

try
{
    if (isset($_POST["login"])) {
        if (empty($_POST["username"]) || empty($_POST["password"])) {
            $message = '<label>All fields are required</label>';
        } else {
            $query = "SELECT * FROM tbl_login  WHERE USERNAME = :username AND PASSWORD = :password ";
            $statement = $pdo->prepare($query);
            $statement->execute(
                array(
                    'username' => $_POST["username"],
                    'password' => $_POST["password"],
                )
            );
            $count = $statement->rowCount();
            $user = $statement->fetchAll(PDO::FETCH_ASSOC);
            // echo '<pre>';
            // var_dump($user[0]);
            // echo '<pre>';

            if ($count > 0) {
                $_SESSION["username"] = $_POST["username"];
                header("location:./order/order.php");
            } else {
                $message = '<label>Wrong Data or Your Account is Deactivated</label>';
            }
        }
    }
} catch (PDOException $error) {
    $message = $error->getMessage();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/index.css" />
    <title>Bicycle Kings</title>
  </head>
  <body>
    <div class="main">
      <div class="logo">
        <img
          src="./images/admin.png"
          alt="Bicycle King Shop"
          width="400"
          height="140"
        />
      </div>
      <div class="login">
        <div class="admin">
            <img src="./images/logoo.png" alt="admin" width="50"
            height="40">
            <h1>ADMIN</h1>
        </div>
        <div class="login-form">
			<form method="POST" action ="">
				<?php if (isset($_GET['error'])) {?>
						<p class="error"><?php echo $_GET['error']; ?></p>
				<?php }?>
                <div class="form-group">
					<label for="">Username:</label>
					<input type="text" class="form-control" name="username" placeholder="Enter Username" required>
				</div>

				<div class="form-group">
					<label for="">Password:</label>
					<input type="password" class="form-control" name="password" placeholder="Enter Password" required>
				</div>

				<input type="submit" name="login" class="btn" value="LOGIN">
            </form>
        </div>
      </div>
    </div>
  </body>
</html>
