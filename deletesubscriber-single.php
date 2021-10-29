<?php 
include('functions.php');

if (!isLevel1()) {
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
  * Delete a user
  */

require "config.php";
require "common.php";

if (isset($_GET["id"])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);

    $id = $_GET["id"];

    $sql = "DELETE FROM subscribers WHERE id = :id";

    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $success = "Subscriber successfully deleted";
  } catch(PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
  }
}
if (isset($_POST['submit'])) {
    try{
  
      $connection = new PDO($dsn, $username, $password, $options);
  
      $sql = "SELECT *
      FROM subscribers
      WHERE firstname = :firstname
      AND lastname = :lastname";
  
      $firstname = $_POST['firstname'];
      $lastname = $_POST['lastname'];
  
      $statement = $connection->prepare($sql);
      $statement->bindParam(':firstname', $firstname, PDO::PARAM_STR);
      $statement->bindParam(':lastname', $lastname, PDO::PARAM_STR);
      $statement->execute();
  
      $result = $statement->fetchAll();
    } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
    }
  }

?>

<?php require "templates/header.php"; ?>

<h2>Delete</h2>

<?php
if (isset($_POST['submit'])) {
  if ($result && $statement->rowCount() > 0) { ?>
    <h2>Results</h2>

    <table>
      <thead>
<tr>
  <th>#</th>
  <th>First Name</th>
  <th>Last Name</th>
  <th>Card Number</th>
  <th>CVV</th>
  <th>Location</th>
  <th>Date</th>
</tr>
      </thead>
      <tbody>
  <?php foreach ($result as $row) { ?>
      <tr>
<td><?php echo escape($row["id"]); ?></td>
<td><?php echo escape($row["firstname"]); ?></td>
<td><?php echo escape($row["lastname"]); ?></td>
<td><?php echo escape($row["cardnumber"]); ?></td>
<td><?php echo escape($row["cvv"]); ?></td>
<td><?php echo escape($row["location"]); ?></td>
<td><?php echo escape($row["date"]); ?> </td>
<td><a href="deleteSubscriber2.php?id=<?php echo escape($row["id"]); ?>">Delete</a></td>
      </tr>
    <?php } ?>
      </tbody>
  </table>
  <?php } else { ?>
    > No results found for <?php echo escape($_POST['lastname']); ?>.
  <?php }
} ?>
<h2>Please Confirm the following Information</h2>

<form method="post">
  <label for="location">First Name</label>
  <input type="text" id="firstname" name="firstname">
  <label for="location">Last Name</label>
  <input type="text" id="lastname" name="lastname">
  <input type="submit" name="submit" value="View Results">
</form>
<a href="userLogin.php">Back to home</a>

<?php require "templates/footer.php"; ?>