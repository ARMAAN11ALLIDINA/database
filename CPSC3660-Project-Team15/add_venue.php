<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Add Venue</title>
</head>


<?php
hd("Adding Venue");
if ( isset($_POST['vname']) && isset($_POST['address'])
    && isset($_POST['city']) && isset($_POST['seats']) ) {

    $vname = $_POST['vname'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $seats = $_POST['seats'];
    $sql = "insert into VENUE (vname, address, city, seats)
            values ('$vname', '$address', '$city', '$seats');";

    if (mysqli_query($conn, $sql)) {
        echo("Venue successfully added.");
        venue_link();
    }
    return;
}
?>

<form method="post">
<p>Name: <input type="text" name="vname"></p>
<p>Address: <input type="text" name="address"></p>
<p>City: <input type="text" name="city"></p>
<p>Seats: <input type="text" name="seats"></p>
<p><input type="submit" value="Add New"/>
<a href="venue.php">Cancel</a></p>
</form>

</body>
</html>
