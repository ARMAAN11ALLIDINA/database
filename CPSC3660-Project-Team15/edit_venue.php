<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head><title>Edit Venue</title></head>

<?php
hd("Updating Venue");
if ( isset($_POST['vname']) && isset($_POST['address'])
    && isset($_POST['city']) && isset($_POST['venue_id']) ) {

    $venue_id = $_POST['venue_id'];
    $vname = $_POST['vname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $seats = $_POST['seats'];

    if (strlen($venue_id) < 1){
        // Check if venue ID is actually there
        echo("<p>Error: venue ID not set</p>");

    }

    $sql = "update VENUE set
        vname = '$vname', address = '$address', city = '$city', seats = '$seats'
        where venue_id = $venue_id;";

    if (mysqli_query($conn, $sql)) {
        echo("Venue $vanme successfully updated.");
        venue_link();
    }
    return;
}

if ( ! isset($_GET['venue_id']) ) {
  echo("<p>Error missing venue ID</p>");
  venue_link();
  return;
}

$venue_id = $_GET['venue_id'];
$vname = "";
$address = "";
$city = "";
$seats = "";

$sql = "select * from VENUE where venue_id = $venue_id;";
$query = mysqli_query($conn, $sql);
if ($result = mysqli_fetch_assoc($query)) {
    $vname = $result['vname'];
    $address = $result['address'];
    $city = $result['city'];
    $seats = $result['seats'];
}

?>

<form method="post">
<p>Name: <input type="text" name="vname" value="<?= $vname ?>"></p>
<p>Address: <input type="text" name="address" value="<?= $address ?>"></p>
<p>City: <input type="text" name="city" value="<?= $city ?>"></p>
<p>Seats: <input type="text" name="seats" value="<?= $seats ?>"></p>
<input type="hidden" name="venue_id" value="<?= $venue_id ?>">
<p><input type="submit" value="Update"/>
<a href="venue.php">Cancel</a></p>
</form>

</body>
</html>
