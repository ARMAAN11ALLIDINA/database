<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Add Guest</title>
</head>

<?php
hd("Adding Guest");
if ( isset($_POST['name']) && isset($_POST['phone'])
    && isset($_POST['email']) ) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $sql = "insert into GUEST (name, phone, email)
            values ('$name', '$phone', '$email');";

    if (mysqli_query($conn, $sql)) {
        echo("Guest successfully added.");
        guest_link();
    }
    return;
}
?>

<form method="post">
<p>Name: <input type="text" name="name"></p>
<p>Phone: <input type="text" name="phone"></p>
<p>Email: <input type="text" name="email"></p>
<p><input type="submit" value="Add New"/>
<a href="guest.php">Cancel</a></p>
</form>

</body>
</html>
