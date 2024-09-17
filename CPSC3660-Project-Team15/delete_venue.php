<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Delete venue</title>
</head>


<?php
hd("Deleting Venue");
//
if ( isset($_POST['delete']) && isset($_POST['venue_id']) ) {
    $sql = "delete from VENUE where venue_id = ".$_GET['venue_id'].";";
    if (mysqli_query($conn, $sql)) {
        echo("venue successfully deleted.");
        venue_link();
    }
    return;
}

// First time we enter delete, we come here. Checks if ID is included and valid.
if (isset($_GET['venue_id'])) {
    $sql = "select * from VENUE where venue_id = ".$_GET['venue_id'].";";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        // There does exist a venue with the ID. Ask to confirm deletion.
        $row = mysqli_fetch_assoc($result);
        echo("Delete venue ".$row['vname']."?");
    } else {
        // Couldn't find ID in database.
        echo("Error: venue ID is invalid");
        venue_link();
        return;
    }
} else {
    echo("Error: Missing venue ID");
    venue_link();
    return;
}
?>

<form method="post">
<input type="hidden" name="venue_id" value="<?= $row['venue_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="venue.php">Cancel</a>
</form>

</body>
</html>
