<!DOCTYPE html>
<!--team 1
	12-6-2018
	CSCI 3000 DA 
	Drinks_Account_create.php allows the user to securly create an account
	to be able to login to our website 
	and is connected to create_account.css file-->
<html>
<head>
	<!--connects to create_account.css-->
	<link rel="stylesheet" href="Create_Account.css"> 
</head>
<body>

<div id="rectangle">
<form action="Drinks_homePage.php">
    <input id="top" type="submit" value="Home Page" />
</form>


<?php

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
//initializes variables
$nameErr="Enter Name";
$userErr="Enter Username";
$passErr="Enter Password";
$idErr="Enter ID";
$name=$user=$pass=$id="";
$testuser=$testid=$warn="";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	//checks all the variables for valid entries
	$ready = "true";
	if(empty($_POST["name"])){
		$nameErr = "Name is required";
		$ready = "false";
	} else{
		 if(strstr($_POST["name"]," ",true)) {
			 $nameErr ="No spaces in your name";
			 $ready = "false"; 
		 }else{
			 
			$name = test_input($_POST["name"]);
			
		 }
		//$name = mysql_real_escape_string($name);
	}
	if(empty($_POST["user"])){
		$userErr = "Username is required";
		$ready = "false";
	} else{
		 if(strstr($_POST["user"]," ",true) ){
			 $userErr = "No spaces in username";
			$ready = "false"; 
		 }else{
			 $testuser = test_input($_POST["user"]);
			 $sql = "SELECT * FROM customers where username = '$testuser';";
			$result = $conn->query($sql);

			//goes through the variable $result which is now an array filled with info from the above sql query
				if ($result->num_rows >=1) {
				$userErr="Username already taken, please pick another";
				$ready ="false";
				}else{$user = test_input($_POST["user"]);
				}
		 }
		//$user = mysql_real_escape_string($user);
	}
	
	if(empty($_POST["pass"])){
		$passErr = "Password is required";
		$ready = "false";
	} else{
		 if(strstr($_POST["pass"]," ",true)){
			 $passErr = "No spaces in password";
			$ready = "false"; 
		 }else{
			$pass = test_input($_POST["pass"]);
		 }
		
		//$pass = mysql_real_escape_string($pass);
	}
	if(empty($_POST["id"])){
		$idErr = "id is required";
		$ready = "false";
	} else{
		if(strstr($_POST["id"]," ",true)){
			 $idErr = "No spaces in ID";
			$ready = "false"; 
		 }else{
			 
			 $testid = test_input($_POST["id"]);
			 $sql = "SELECT * FROM customers where cust_ID = '$testid';";
			$result = $conn->query($sql);

			//goes through the variable $result which is now an array filled with info from the above sql query
				if ($result->num_rows >=1) {
				$idErr="ID already taken, please pick another";
				$ready ="false";
				}else{$id = test_input($_POST["id"]);
				
				}
		 }
		 
		
		//$id = mysql_real_escape_string($id);
	}
	
	if($ready == "false"){
		$warn = "Account Creation Denied";
		//echo "faliure";
	}elseif($ready == "true"){
			
			$query = "INSERT INTO customers (cust_ID, cust_name, username, password) VALUES ('$id', '$name', '$user', '$pass');";
			
			if ($conn->query($query) === TRUE) {
			$warn="New record created successfully";
			header( 'Location: Drinks_login.php' );
			} else {
			 $conn->error;
			 $warn="Account Creation Denied";
			}

			$conn->close();
		
	}
	
	}

	function test_input($data){
		$data= trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	return $data;}
	
	

	
?>
<!--form to create account-->
<h1>Sign Up</h1>
<form method ="post" action="<?php echo 
htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="text" name="name" placeholder="<?php echo $nameErr;?>"> <br><br>
 <input type="text" name="user" placeholder="<?php echo $userErr;?>">  <br><br>
 <input type="password" name="pass" placeholder="<?php echo $passErr;?>"> <br><br>
 <input type="text" name="id" placeholder="<?php echo $idErr;?>"><br><br>


<input id="sub" type="submit" name="submit" value="Submit">

<h2 id = "warning"><?php echo $warn;?></h2> 
</form>
</div>


</body>
</html>