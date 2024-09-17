<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Delete Band</title>
</head>

<body>
<?php
hd("Deleting Band");
//
if ( isset($_POST['delete']) && isset($_POST['band_id']) ) {
    $sql = "delete from BAND where band_id = ".$_GET['band_id'].";";
    if (mysqli_query($conn, $sql)) {
        echo("Band successfully deleted.");
        band_link();
    }
    return;
}

// First time we enter delete, we come here. Checks if ID is included and valid.
if (isset($_GET['band_id'])) {
    $sql = "select * from BAND where band_id = ".$_GET['band_id'].";";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        // There does exist a band with the ID. Ask to confirm deletion.
        $row = mysqli_fetch_assoc($result);
        echo("Delete band ".$row['name']."?");
    } else {
        // Couldn't find ID in database.
        echo("Error: Band ID is invalid");
        band_link();
        return;
    }
} else {
    echo("Error: Missing Band ID");
    band_link();
    return;
}
?>

<form method="post">
<input type="hidden" name="band_id" value="<?= $row['band_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="band.php">Cancel</a>
</form>

</body>
</html>
