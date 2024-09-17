<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Edit Guest</title>
</head>


<?php
hd("Updating Guest");
if ( isset($_POST['name']) && isset($_POST['phone'])
    && isset($_POST['email']) && isset($_POST['guest_id']) ) {

    $guest_id = $_POST['guest_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if (strlen($guest_id) < 1){
        // Check if guest ID is actually there
        echo("<p>Error: Guest ID not set</p>");

    }

    $sql = "update GUEST set
        name = '$name', phone = '$phone', email = '$email'
        where guest_id = $guest_id;";

    if (mysqli_query($conn, $sql)) {
        echo("Guest successfully updated.");
        guest_link();
    }
    return;
}

if ( ! isset($_GET['guest_id']) ) {
  echo("<p>Error missing Guest ID</p>");
  guest_link();
  return;
}

$guest_id = $_GET['guest_id'];
$name = "";
$phone = "";
$email = "";

$sql = "select * from GUEST where guest_id = $guest_id;";
$query = mysqli_query($conn, $sql);
if ($result = mysqli_fetch_assoc($query)) {
    $name = $result['name'];
    $phone = $result['phone'];
    $email = $result['email'];
}

?>

<form method="post">
<p>Name: <input type="text" name="name" value="<?= $name ?>"></p>
<p>Phone: <input type="text" name="phone" value="<?= $phone ?>"></p>
<p>Email: <input type="text" name="email" value="<?= $email ?>"></p>
<input type="hidden" name="guest_id" value="<?= $guest_id ?>">
<p><input type="submit" value="Update"/>
<a href="guest.php">Cancel</a></p>
</form>

</body>
</html>
