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
<h1>Welcome to the Credit Card Vault</h1>
<ul>
  <li>
    <a href="createSubscriber.php"><strong>Add Credit Card Information</strong></a>
  </li>
  <li>
    <a href="updateSubscriber.php"><strong>Update My Information</strong></a>
  </li>
  <li>
    <a href="deletesubscriber-single.php"><strong>Delete My Information</strong></a>
  </li>
</ul>

<?php include "templates/footer.php"; ?>