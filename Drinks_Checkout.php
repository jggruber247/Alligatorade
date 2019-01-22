<!DOCTYPE html>
<html>
<head>
	<title>Alligatorade Sport Drinks</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="checkout.css">
</head>

<!--GARRETT'S CODE BEGIN-->
<script>
function isLoggedIn(status) {
	if (status == "true") {
		document.getElementById('login').style.display='none';
		document.getElementById('welcome').style.display='block';
	}
}
</script>
<!--GARRETT'S CODE END-->

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


<!--GARRETT'S CODE BEGIN-->
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
<body onLoad = isLoggedIn('<?php print $status; ?>');>
<img id="logo" src="alligatoradeLogoV1.png" title="Bite Me, Gatorade!">
<h1>Checkout</h1>
<!--Navigation Box-->
<div class="topper">
	<p id="welcome">Welcome, <?php echo $cow["cust_name"]; ?>!</p>
	<form action="Drinks_login.php">
		<input class="nav" id="login" type="submit" value="Login" />
	</form>
	<form action="Drinks_Orders.php">
		<input class="nav" type="submit" value="Orders" />
	</form>
	<form action="Drinks_Homepage.php">
		<input class="nav" id = "home" type="submit" value="HomePage" />
	</form>
</div>
<!--GARRETT'S CODE END-->


<div id="rectangle">
<?php
//sql code to get the drinks and info from the cart table where the customer logged ins value is true.
//if other customers status is true, 1, then the cart will display there cart items aswell if they have some.
  $sql = "SELECT D_id, item, price, c_quantity FROM cart, customers c WHERE cart.C_custid = c.cust_ID AND STATUS = true;";
	$result = $conn->query($sql);
?>

<!--GARRETT'S CODE BEGIN-->
<h2>Your Cart</h2>
<!--Table for the cart-->
<table>
    <thead>
        <tr>
            <th>Drink ID</th>
            <th>Drink Name</th>
            <th>Subtotal</th>
			<th>Quantity</th>
        </tr>
    </thead>
    <tbody>
        <!--Use a while loop to make a table row for every DB row-->
        <?php while($row = $result->fetch_assoc()) : ?>
        <tr>
            <!--Each table column is echoed in to a td cell-->
            <td><?php echo $row["D_id"]; ?></td>
            <td><?php echo $row["item"]; ?></td>
            <td>$<?php echo $row["price"]; ?></td>
			<td><?php echo $row["c_quantity"]; ?></td>
        </tr>
        <?php endwhile ?>
    </tbody>
</table>

<?php
  //Calculates the cart's total
  $total = 0;
  $sql = "SELECT SUM(price) AS sum_total FROM cart, customers c WHERE cart.C_custid = c.cust_ID AND STATUS = true;";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc();
	$total = $row['sum_total'];
?>
<p>Total: $<?php echo $total; ?></p>
<!--GARRETT'S CODE END-->

<?php
$conn->close();
	echo "<br>";
?>


<?php
//this giant block of php code executes the buy button.
if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['buy']))
	{
		func();
	}
	function func()
{

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

				$date = date('Y-m-d');
			//	$ord = 16;

	// code...

/*
						while($row = $newno->fetch_assoc()) {
							$st = $row["C_custid"];
						}

						if(empty($_POST["st"])){
							//$ = "Name is required";
							$ready = "false";
						} else{
						$newsqll ="DELETE FROM cart where C_custid = '$st' ;";
						$newnow = $conn->query($newsqll);
					}
*/
					//$conn->close();




	$nameC="";
	$num="";
	$cv="";
	$exp="";
	if ($_SERVER["REQUEST_METHOD"] == "POST"){



		$ready = "true";

		if(empty($_POST["nameC"])){
			//$ = "Name is required";
			$ready = "false";
		} else{
			 if(strstr($_POST["nameC"]," ",true)) {

				 $ready = "false";
			 }else{
				$nameC = test_input($_POST["nameC"]);
				//echo "successful";
			 }
			//$name = mysql_real_escape_string($name);

		}
		if(empty($_POST["num"])){
			//$userErr = "Number is required";
			$ready = "false";
		} else{
			 if(strstr($_POST["num"]," ",true) ){

				$ready = "false";
			 }else{
				$num = test_input($_POST["num"]);
			 }
			//$user = mysql_real_escape_string($user);

		}
		if(empty($_POST["cv"])){
			//$ = "CV is required";
			$ready = "false";
		} else{
			 if(strstr($_POST["cv"]," ",true)) {

				 $ready = "false";
			 }else{
				$cv = test_input($_POST["cv"]);
				//echo "successful";
			 }
			//$name = mysql_real_escape_string($name);

		}
		if(empty($_POST["exp"])){
			//$ = "N is required";
			$ready = "false";
		} else{
			 if(strstr($_POST["exp"]," ",true)) {

				 $ready = "false";
			 }else{
				$exp = test_input($_POST["exp"]);
				//echo "successful";
			 }
			//$name = mysql_real_escape_string($name);

		}
		if (preg_match('/[\'^£$%&*()}{@#~?><>\/,|=_+¬-]/', $_POST["nameC"]))
		{
		    // one or more of the 'special characters' found
				$ready = "false";
		}
		if (preg_match('/[\'^£$%&*()}{@#~?><>\/,|=_+¬-]/', $_POST["num"]))
		{
		    // one or more of the 'special characters' found
				$ready = "false";
		}
		if (preg_match('/[\'^£$%&*()}{@#~?><>\/,|=_+¬-]/', $_POST["cv"]))
		{
		    // one or more of the 'special characters' found
				$ready = "false";
		}
		if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $_POST["exp"]))
		{
		    // one or more of the 'special characters' found
				$ready = "false";
		}
		if($ready == "false"){
			echo "Invalid Information";
		}elseif($ready == "true"){
$query = "INSERT payment (cardNum, cardName, cardCV, expDate) VALUES ('$num', '$nameC', '$cv', '$exp');";
//sql code copies the cart into the orders table then clears the cart table for the logged in user.
$mysql = "INSERT INTO orders (o_cust_id, o_drinkID, quantity, total_price) SELECT C_custid, D_id, c_quantity, price FROM cart, customers c WHERE cart.C_custid = c.cust_ID AND STATUS = true;";
$result = $conn->query($mysql);

$slq = "UPDATE orders SET `o_date` = '$date' where o_cust_id IN (SELECT C_custid from cart);";
$now = $conn->query($slq);

$news = "SELECT c_quantity, D_id from cart;";
$new =$conn->query($news);

while($row = $new->fetch_assoc()) {
	$st = $row["c_quantity"];
	$sl = $row["D_id"];
	$news ="UPDATE stock SET inventory= (inventory-'$st') WHERE drink_ID = '$sl';";
	$ne = $conn->query($news);
}


$newsql = "SELECT DISTINCT C_custid from cart, customers c where cart.C_custid = c.cust_ID AND STATUS = true;";
$newno =$conn->query($newsql);
				$lqs = "DELETE FROM cart;";
				$conn->query($lqs);

				if ($conn->query($query) === TRUE) {
				echo "Successful";
				header( 'Location: Drinks_Checkout.php' );
				} else {
				echo "Error: " . $query . "<br>" . $conn->error;
				}
header( 'Location: Drinks_Orders.php' );
				$conn->close();
			}

	}

}
		//helps secure the input data
		function test_input($data){
		$data= trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	return $data;}


?>

<!--<script>
function myFunction() {
    var check = confirm("Would you like to procced to checkout?")
		if (check) {

		}else{
			window.location = ("Drinks_Homepage.php");
		}
}
</script>
-->
<h2>Credit Card Info</h2>


<form method ="post" action="<?php echo
htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Card Name: <input type="text" name="nameC"> <br><br>
Card Number: <input type="text" name="num"> <br><br>
Security Code: <input type="text" name="cv"> <br><br>
Expiration Date: <input type="text" name="exp"> <br><br>
<!--form button that activates the buy button-->
    <input id = "go" type="submit" name="buy" value="GO" />
</form>



</div>


</body>
</html>
