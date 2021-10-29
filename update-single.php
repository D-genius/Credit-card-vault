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
  * Use an HTML form to edit an entry in the
  * users table.
  *
  */
require "config.php";
require "common.php";
//Decryption Keys
$cardkey = 'pass1234';
$cvvkey = 'pass5678';
if (isset($_POST['submit'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $user =[
      "id"        => $_POST['id'],
      "firstname" => $_POST['firstname'],
      "lastname"  => $_POST['lastname'],
      "cardnumber"     => $_POST['cardnumber'],
      "cvv"       => $_POST['cvv'],
      "location"  => $_POST['location'],
      "date"      => $_POST['date']
    ];

    $sql = "UPDATE subscribers 
            SET id = :id,
              firstname = :firstname,
              lastname = :lastname,
              cardnumber = AES_ENCRYPT(:cardnumber, '$cardkey'),
              cvv = AES_ENCRYPT(:cvv, '$cvvkey'),
              location = :location,
              date = :date
            WHERE id = :id";

  $statement = $connection->prepare($sql);
  $statement->execute($user);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
}

if (isset($_GET['id'])) {
  try {
    $connection = new PDO($dsn, $username, $password, $options);
    $id = $_GET['id'];
    $sql = "SELECT id, firstname, lastname, AES_DECRYPT(cardnumber, '$cardkey') as cardnumber, AES_DECRYPT(cvv, '$cvvkey') as cvv, location, date FROM subscribers WHERE id = :id"; 
    $statement = $connection->prepare($sql);
    $statement->bindValue(':id', $id);
    $statement->execute();

    $user = $statement->fetch(PDO::FETCH_ASSOC);
  } catch(PDOException $error) {
      echo $sql . "<br>" . $error->getMessage();
  }
} else {
    echo "Something went wrong!";
    exit;
}
?>

<?php require "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
  <?php echo escape($_POST['firstname']); ?> successfully updated.
<?php endif; ?>

<h2>Edit a user</h2>

<form method="post">
    <?php foreach ($user as $key => $value) : ?>
      <label for="<?php echo $key; ?>"><?php echo ucfirst($key); ?></label>
      <input type="text" name="<?php echo $key; ?>" id="<?php echo $key; ?>" value="<?php echo escape($value); ?>" <?php echo ($key === 'id' ? 'readonly' : null); ?>>
    <?php endforeach; ?>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="userLogin.php">Back to home</a>

<?php require "templates/footer.php"; ?>