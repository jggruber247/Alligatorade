<!DOCTYPE html>
<html>
<head>

	<link rel="stylesheet" href="admin.css"> 
</head>

<?php
	echo "<h1>ADMIN</h1><br><hr>";
?>
</head>
<body>
<form action="Drinks_Homepage.php">
    <input type="submit" value="HomePage" />
</form>

<br>


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

//this block of php code retreives and displays the inventory table
  $sql = "SELECT drink_ID, dr_name, unit_price, inventory FROM stock";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "Drink ID: ".$row["drink_ID"]. "| Drink Name: " . $row["dr_name"]. "| Price: $" . $row["unit_price"]. "| Stock: " . $row["inventory"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();

	echo "<br>";
	
?>



<?php
			//this gaint section of php allows you to update your inventory
			
			
			
			if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['update']))
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
     
//securly allows the admin the ablility to type in the drink id and the new inventory 
$drink=$amt="";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$ready = "true";
	
	if(empty($_POST["drink"])){
		//$ = "Name is required";
		$ready = "false";
	} else{
		 if(strstr($_POST["drink"]," ",true)) {
			 
			 $ready = "false"; 
		 }else{
			$drink = test_input($_POST["drink"]);
			//echo "dog";
		 }
		//$name = mysql_real_escape_string($name);
	}
	if(empty($_POST["amt"])){
		//$userErr = "amount is required";
		$ready = "false";
	} else{
		 if(strstr($_POST["amt"]," ",true) ){
			 
			$ready = "false"; 
		 }else{
			$amt = test_input($_POST["amt"]);
		 }
		//$user = mysql_real_escape_string($user);
	}
	
	if($ready == "false"){
		echo "faliure";
	}elseif($ready == "true"){
		
			$query = "UPDATE stock SET inventory = '$amt' WHERE drink_ID ='$drink';";
			
			if ($conn->query($query) === TRUE) {
			echo "Update successful";
			header( 'Location: Drinks_Admin.php' );
			} else {
			echo "Error: " . $query . "<br>" . $conn->error;
			}

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
<!--this is the form and button to update the inventory-->
<h2>Update Inventory</h2>
<form method ="post" action="<?php echo 
htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Drink_ID: <input type="text" name="drink"> <br><br>
Inventory: <input type="text" name="amt"> <br><br>
    <input type="submit" name="update" value="Update" />
</form>
<br>

<?php
			//this gaint section of php allows you to delete from stock table
			
			
			
			if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['remove']))
			{
				newfunc();
			}
			function newfunc()
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
     
//securly able to type in the drink id you want to delete
$drinkD="";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	$ready = "true";
	
	if(empty($_POST["drinkD"])){
		//$ = "Name is required";
		$ready = "false";
	} else{
		 if(strstr($_POST["drinkD"]," ",true)) {
			 
			 $ready = "false"; 
		 }else{
			$drinkD = test_input($_POST["drinkD"]);
			//echo "dog";
		 }
		//$name = mysql_real_escape_string($name);
	}
	
	if($ready == "false"){
		echo "faliure";
	}elseif($ready == "true"){
		
			$query = "DELETE From stock WHERE drink_ID ='$drinkD';";
			
			if ($conn->query($query) === TRUE) {
			echo "Update successful";
			header( 'Location: Drinks_Admin.php' );
			} else {
			echo "Error: " . $query . "<br>" . $conn->error;
			}

			$conn->close();
		
	}
	
	}}
		
	
?>

<!--form section to type in drink id and delete it-->
<h2>Delete Drinks</h2>
<form method ="post" action="<?php echo 
htmlspecialchars($_SERVER["PHP_SELF"]);?>">
Drink_ID: <input type="text" name="drinkD"> <br><br>
    <input type="submit" name="remove" value="Delete" />
</form>


</body>
</html>