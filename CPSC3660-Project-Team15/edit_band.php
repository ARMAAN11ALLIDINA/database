<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Edit Band</title>
</head>


<?php
hd("Updating Band");
if ( isset($_POST['name']) && isset($_POST['phone'])
    && isset($_POST['email']) && isset($_POST['band_id']) && isset($_POST['manager']) ) {

    $band_id = $_POST['band_id'];
    $name = $_POST['name'];
    $manager = $_POST['manager'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    if (strlen($band_id) < 1){
        // Check if band ID is actually there
        echo("<p>Error: Band ID not set</p>");

    }

    $sql = "update BAND set
        name = '$name', manager = '$manager', phone = '$phone', email = '$email'
        where band_id = $band_id;";

    if (mysqli_query($conn, $sql)) {
        echo("Band successfully updated.");
        band_link();
    }
    return;
}

if ( ! isset($_GET['band_id']) ) {
  echo("<p>Error missing Band ID</p>");
  band_link();
  return;
}

$band_id = $_GET['band_id'];
$name = "";
$phone = "";
$email = "";
$manager = "";

$sql = "select * from BAND where band_id = $band_id;";
$query = mysqli_query($conn, $sql);
if ($result = mysqli_fetch_assoc($query)) {
    $name = $result['name'];
    $manager = $result['manager'];
    $phone = $result['phone'];
    $email = $result['email'];

}

?>

<form method="post">
<p>Band Name: <input type="text" name="name" value="<?= $name ?>"></p>
<p>Manager Name: <input type="text" name="manager" value="<?= $manager ?>"></p>
<p>Phone: <input type="text" name="phone" value="<?= $phone ?>"></p>
<p>Email: <input type="text" name="email" value="<?= $email ?>"></p>
<input type="hidden" name="band_id" value="<?= $band_id ?>">
<p><input type="submit" value="Update"/>
<a href="band.php">Cancel</a></p>
</form>

</body>
</html>
