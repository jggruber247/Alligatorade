<!DOCTYPE html>
<html>
<head>
	<title>Alligatorade Sport Drinks</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="homepage.css"> 
</head>
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
<script>
var logged = false;
//Asks the user the amount they wish to purchase
function addToCart(id, drink, available, price) {
	if (logged) {
		var avail = Math.floor(available);
		if (avail <= 0) { //If no stock is available
			alert("Sorry, currently out of stock.");
		}
		else {
			var amt = prompt("Enter the number of bottles of " + drink + " you wish to purchase: \n(" + avail + " units available)","");
			if (amt == null) //If user selects CANCEL
				alert("Order Cancelled.");
			else {	
				while (amt > avail ) { //If the user requests more than is available, they are prompted to enter a new number
					alert("Sorry, insufficient stock available.");
					amt = prompt("Enter amount you wish to purchase: (" + avail + " units available)","");
					if (amt == null) { //If user selects CANCEL
						alert("Order Cancelled.");
						amt = avail+1;
						break;
					}
				}
				if (amt <= avail ) {
					//Displays a dynamic confirmation message and button to add to cart
					var total = Math.round((amt * price)*100)/100;
					document.getElementById('drink_id').value = id;
					document.getElementById('amt').value = amt;
					document.getElementById('dname').value = drink;
					document.getElementById('price').value = total;
					var text1 = "Add " + amt + " bottle(s) of";
					var text2 = "\"" + drink + "\" to Cart?";
					var text3 = "Subtotal: $" + total;
					document.getElementById('line1').style.display='block';
					document.getElementById('line1').innerHTML = text1;
					document.getElementById('line2').innerHTML = text2;
					document.getElementById('line3').innerHTML = text3;
					document.getElementById('addCart').style.display='block';
				}
			}
		}
	}
	else {
		alert("You must log in before you can make purchases.");
	}
}

//Checks if the user is logged in, and if so, changes the "status" global variable to true,
	//then hides the login button and displays the logout button and the welcome text.
	//The function is run everytime the page is loaded.
function isLoggedIn(status) {
	if (status == "true") {
		document.getElementById('login').style.display='none';
		document.getElementById('logout').style.display='block';
		document.getElementById('welcome').style.display='block';
		logged = true;
	}
}


</script>

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
$userId=$drinkId=$drinkName=$drinkPrice=$drinkAmount="";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	if($_POST["logout"]) {
		$sql = "UPDATE customers SET status = 0 where status = 1;";
		$result = $conn->query($sql);
		header( 'Location: Drinks_Homepage.php' );
	}
	elseif($_POST["addCart"]) {
		$userId = ($_POST["userId"]);
		$drinkId = ($_POST["drinkId"]);
		$drinkName = ($_POST["drinkName"]);
		$drinkPrice = ($_POST["drinkPrice"]);
		$drinkAmount = ($_POST["drinkAmount"]);
		$query = "INSERT INTO cart (C_custid, D_id, item, price, c_quantity) VALUES ('$userId', '$drinkId', '$drinkName', '$drinkPrice', '$drinkAmount');";
		if ($conn->query($query) === TRUE) {
			$warn="Added to Cart Successfully";
			header( 'Location: Drinks_Homepage.php' );
		} else {
			$conn->error;
			$warn="Cart Add Unsuccessful";
		}
	}
}
?>
<body onLoad = isLoggedIn('<?php print $status; ?>');>
<img id="logo" src="alligatoradeLogoV1.png" title="Bite Me, Gatorade!">
<div class="topper">
	<p id="welcome">Welcome, <?php echo $cow["cust_name"]; ?>!</p>
	<!--these are form buttons-->
	<form action="Drinks_login.php">
		<input id="login" type="submit" value="Login" />	
	</form>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input name="logout" id="logout" type="submit" value="Logout" />
	</form>
	<form action="Drinks_Checkout.php">
		<input type="submit" value="Checkout" />
	</form>
	<form action="Drinks_Orders.php">
		<input type="submit" value="Orders" />
	</form>
	<p class="cart" id="line1"></p>
	<p class="cart" id="line2"></p>
	<p class="cart" id="line3"></p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input class="hidden" id="userId" type="text" name="userId" value="<?php echo $cow["cust_ID"]; ?>" />
		<input class="hidden" id="drink_id" type="text" name="drinkId" />
		<input class="hidden" id="dname" type="text" name="drinkName" />
		<input class="hidden" id="price" type="text" name="drinkPrice" />
		<input class="hidden" id="amt" type="text" name="drinkAmount" />
		<input id="addCart" type="submit" name="addCart" value="Add to Cart" />
	</form>
</div>
<h1>About Us</h1>
<p>Founded in 2018 by Spencer Velchek, Kyle Wilson, and Garrett Gruber, <i>Alligatorade LLC</i> is all about <b>crunching</b> down on overpriced sports drinks and delivering the best electrolyte-replenishing beverages this side of the Everglades! Guaranteed fresh, or we'll send you an alligator. That's right, a real, live, <b>hungry</b> alligator! Use it to get rid of your cat or annoying offspring. Just pay shipping and handling and insurance.</p>
<h1>Products</h1>
<div class="container">
<table>
    <thead>
		<tr>
			<?php 	$sql = "SELECT dr_name FROM stock";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()) : ?>
			<th><?php echo $row["dr_name"]; ?></th>
			<?php endwhile ?>
		</tr>
	</thead>
	<tbody>
        <!--Use a while loop to make a table column for every DB row-->
		<tr>
			<?php 	$sql = "SELECT pic FROM stock";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()) : ?>
			<td><img src="<?php echo $row["pic"]; ?>"></td>
			<?php endwhile ?>
		</tr>
		<tr>
			<?php 	$sql = "SELECT unit_price FROM stock";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()) : ?>
			<td><b>$<?php echo $row["unit_price"]; ?></b> <small> (plus S&H)</small></td>
			<?php endwhile ?>
		</tr>
		<tr>
			<?php 	$sql = "SELECT inventory FROM stock";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()) : ?>
			<td>In Stock: <?php echo $row["inventory"]; ?></td>
			<?php endwhile ?>
		</tr>
		<tr>
			<?php 	$sql = "SELECT drink_ID, dr_name, inventory, unit_price FROM stock";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()) : ?>
			<td><button onclick="addToCart('<?php print $row["drink_ID"]; ?>','<?php print $row["dr_name"]; ?>','<?php print $row["inventory"]; ?>','<?php print $row["unit_price"]; ?>')">BUY NOW!</button></td>
			<?php endwhile ?>
		</tr>
    </tbody>
</table>
</div>
<?php
$conn->close();
//ends the connection
	echo "<br>";
?>
</body>
</html>