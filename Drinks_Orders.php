<!DOCTYPE html>
<html>
<head>
	<title>Alligatorade Sport Drinks</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="orders.css"> 
</head>
<script>
function isLoggedIn(status) {
	if (status == "true") {
		document.getElementById('login').style.display='none';
		document.getElementById('logout').style.display='block';
		document.getElementById('welcome').style.display='block';
	}
}
</script>
<?php
//this block of php code connects to the database
// note your servername, username, and password should be the same, check your privlidges section in one of the databases to find out
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "drinks";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
?>
<?php 
	$status = "false";
	$sql = "Select * from customers where status = 1;";
	$result = $conn->query($sql);
			//goes through the variable $result which is now an array filled with info from the above sql query
				if ($result->num_rows >=1) {
				$status = "true";
				$cow = $result->fetch_assoc();
				}
?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if($_POST["logout"]) {
			$sql = "UPDATE customers SET status = 0 where status = 1;";
			$result = $conn->query($sql);
			header( 'Location: Drinks_Orders.php' );
		}
}
?>


<body onLoad = isLoggedIn('<?php print $status; ?>');>
<img id="logo" src="alligatoradeLogoV1.png" title="Bite Me, Gatorade!">
<!--Navigation Box-->
<h1>Your Orders</h1>
<div class="topper">
	<p id="welcome">Welcome, <?php echo $cow["cust_name"]; ?>!</p>
	<form action="Drinks_login.php">
		<input id="login" type="submit" value="Login" />	
	</form>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input name="logout" id="logout" type="submit" value="Logout" />
	</form>
	<form action="Drinks_Homepage.php">
		<input type="submit" value="HomePage" />
	</form>
</div>


<?php

//sql code displays the orders table content from the logged in user, similar to Drinks_checkout.php
  $sql = "SELECT `order_ID`, `O_date`, `o_cust_id`, `o_drinkID`, `Quantity`, `total_price` FROM `orders`, customers c WHERE c.cust_ID = o_cust_id AND c.status = true";
$result = $conn->query($sql);
?>
<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Order Date</th>
            <th>Customer ID</th>
			<th>Drink ID</th>
			<th>Quantity</th>
			<th>Order Total</th>
        </tr>
    </thead>
    <tbody>
        <!--Use a while loop to make a table row for every DB row-->
        <?php while($row = $result->fetch_assoc()) : ?>
        <tr>
            <!--Each table column is echoed in to a td cell-->
            <td>OID<?php echo $row["order_ID"]; ?></td>
            <td><?php echo $row["O_date"]; ?></td>
            <td><?php echo $row["o_cust_id"]; ?></td>
			<td><?php echo $row["o_drinkID"]; ?></td>
			<td><?php echo $row["Quantity"]; ?></td>
			<td>$<?php echo $row["total_price"]; ?></td>
        </tr>
        <?php endwhile ?>
    </tbody>
</table>
<?php
$conn->close();
	echo "<br>";
	?>
</body>
</html>