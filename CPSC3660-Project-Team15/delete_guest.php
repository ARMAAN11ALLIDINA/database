<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Delete Guest</title>
</head>

<body>
<?php
hd("Deleting Guest");
//
if ( isset($_POST['delete']) && isset($_POST['guest_id']) ) {
    $sql = "delete from GUEST where guest_id = ".$_GET['guest_id'].";";
    if (mysqli_query($conn, $sql)) {
        echo("Guest successfully deleted.");
        guest_link();
    }
    return;
}

// First time we enter delete, we come here. Checks if ID is included and valid.
if (isset($_GET['guest_id'])) {
    $sql = "select * from GUEST where guest_id = ".$_GET['guest_id'].";";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        // There does exist a guest with the ID. Ask to confirm deletion.
        $row = mysqli_fetch_assoc($result);
        echo("Delete guest ".$row['name']."?");
    } else {
        // Couldn't find ID in database.
        echo("Error: Guest ID is invalid");
        guest_link();
        return;
    }
} else {
    echo("Error: Missing Guest ID");
    guest_link();
    return;
}
?>

<form method="post">
<input type="hidden" name="guest_id" value="<?= $row['guest_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="guest.php">Cancel</a>
</form>

</body>
</html>
