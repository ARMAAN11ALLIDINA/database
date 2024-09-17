<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Add Band</title>
</head>

<?php
hd("Adding Band");
if ( isset($_POST['name']) && isset($_POST['phone'])
    && isset($_POST['email']) && isset($_POST['manager']) ) {

    $name = $_POST['name'];
    $manager = $_POST['manager'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = "insert into BAND (name, manager, phone, email)
            values ('$name', '$manager', '$phone', '$email');";

    if (mysqli_query($conn, $sql)) {
        echo("Band successfully added.");
        band_link();
    }
    return;
}
?>

<form method="post">
<p>Band Name: <input type="text" name="name"></p>
<p>Manager Name: <input type="text" name="manager"></p>
<p>Phone: <input type="text" name="phone"></p>
<p>Email: <input type="text" name="email"></p>
<p><input type="submit" value="Add New"/>
<a href="band.php">Cancel</a></p>
</form>

</body>
</html>
