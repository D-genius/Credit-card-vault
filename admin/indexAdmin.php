<?php 
include('../functions.php');

if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<h1>View For Admin</h1>
<ul>
  <li>
    <a href="readSubscriber.php"><strong>Read</strong></a> - Find a subscriber
  </li>
  <li>
    <a href="deleteSubscriber.php"><strong>Delete</strong></a> - Delete a subscriber
  </li>
</ul>

<?php include "../templates/footer.php"; ?>