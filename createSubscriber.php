<?php 
include('functions.php');

if (!isLevel1() && !isLevel2() && !isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}
?>
<?php

/**
  * Use an HTML form to create a new entry in the
  * users table.
  *
  */


if (isset($_POST['submit'])) {
  require "config.php";
  require "common.php";
    try{
    $connection = new PDO($dsn, $username, $password, $options);
    echo "Connected successfully.";
			} catch(PDOException $error){
          echo "Connection error: " . $error->getMessage();
        }
  

  //Encrypting card number and cvv
  $cardkey = 'pass1234';
  $cvvkey = 'pass5678';
  
  //Insert Statement
  $sql = "INSERT INTO subscribers ( firstname, lastname, cardnumber, cvv, location)
          VALUES (:firstname, :lastname, AES_ENCRYPT(:cardnumber, '$cardkey'), AES_ENCRYPT(:cvv, '$cvvkey'), :location)";
  $sql_statement = $connection->prepare($sql);
  $sql_statement->bindParam(':firstname', $_REQUEST['firstname']);
  $sql_statement->bindParam(':lastname',  $_REQUEST['lastname']);
  $sql_statement->bindParam(':cardnumber', $_REQUEST['cardnumber']);
  $sql_statement->bindParam(':cvv', $_REQUEST['cvv']);
  $sql_statement->bindParam(':location', $_REQUEST['location']);
  if ($sql_statement->execute()) {
    echo "New record created successfully";
  } else {
    echo "Unable to create record";
  }

}  
?>

<?php require "templates/header.php"; ?>
<h2>Add a Subscriber</h2>
    <form method="post">
    	<label for="firstname">First Name</label>
    	<input type="text" name="firstname" id="firstname">
    	<label for="lastname">Last Name</label>
    	<input type="text" name="lastname" id="lastname">
    	<label for="cardnumber">Card Number</label>
    	<input type="text" name="cardnumber" id="cardnumber">
    	<label for="cvv">CVV</label>
    	<input type="text" name="cvv" id="cvv">
		<label for="location">Location</label>
  		<input type="text" name="location" id="location">
    	<input type="submit" name="submit" value="Submit">
    </form>

    <a href="userLogin.php">Back to home</a>

<?php include "templates/footer.php"; ?>