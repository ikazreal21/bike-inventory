
<?php

session_start();

if (isset($_SESSION['username'])){
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" href="login.css">
</head>	
	<body>
		<h1>pending view items <?php echo $_SESSION['username'];?></h1>
	</body>
</html>
		
		
		
		
<?php
} else{
	header("Location: index.php");
	exit();
}
?>