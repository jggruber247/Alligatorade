<!DOCTYPE html>

<!--team 1
	12-6-2018
	CSCI 3000 DA 
	Drinks_login.php allows the user to securly login into our website 
	and is connected to login.css file-->
<html>
<head>
	<!--links to login.css-->
	<link rel="stylesheet" href="login.css"> 
</head>
<body>

<div id="rectangle">

<!--form that takes you back to home page-->
<form  action="Drinks_homePage.php">
    <input id="top" type="submit" value="Home Page" />
</form>

<h1>Sign In</h1>

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
//initializes variables
$ready= "true"; //boolean variable.
$userErr="Enter Username";
$passErr="Enter Password";
$ERR="";
$user=$pass="";
if ($_SERVER["REQUEST_METHOD"] == "POST"){
	//checks the user varible
	if(empty($_POST["user"])){
		$userErr = "Username is required";
		$ready = "false";
	} else{
		 if(strstr($_POST["user"]," ",true) ){
			 $userErr = "No Spaces in Username";
			$ready = "false"; 
		 }else{
			$user = test_input($_POST["user"]);
		 }
	}
	//check the pass variable
	if(empty($_POST["pass"])){
		$passErr = "Password is required";
		$ready = "false";
	} else{
		 if(strstr($_POST["pass"]," ",true)){
			$passErr = "No Spaces in Password";
			$ready = "false"; 
		 }else{
			$pass = test_input($_POST["pass"]);
		 }
	}
	
	//checks to see if all variables are valid
	if($ready == "false"){
		//if not valid the message pops up
		$ERR = "Login Denied";
	}elseif($ready == "true"){
			//if it is valid a query is called to the database
			$sql = "SELECT * FROM customers WHERE username='$user' AND password='$pass'";
			$result = $conn->query($sql);

			//checks if the login is succesful
			if ($result->num_rows ==1) {
			$ERR= "login succesful";
				$sql = "UPDATE customers". " SET status = true " . "WHERE username='$user' AND password='$pass'";
			$result = $conn->query($sql);
			//takes you to home page if successful
			header( 'Location: Drinks_Homepage.php' );
			} else {
				//if presents the msg
			$conn->error;
			$ERR = "Username or Password is Invalid";
			}
			//ends the connection
			$conn->close();
		
	}
}
		//function to help clean the variables
	function test_input($data){
		$data= trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
	return $data;}
	
	
?>
<br>
<!--main form to login-->
<form method ="post" action="<?php echo 
htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<input type="text" name="user" placeholder="<?php echo $userErr;?>"> <br><br>
<input type="password" name="pass" placeholder="<?php echo $passErr;?>"> <br><br>
<br><br>
	<input id ="sub" type="submit" name="submit" value="Submit">
</form>
<br>
<!--button to take user to Drinks_Account_Create.php-->
<form action="Drinks_Account_Create.php">
	<input id="create" type="submit" value="Create Account" >
</form>
<h2 id="btmERR"><?php echo $ERR;?></h2>
</div>


</body>
</html>