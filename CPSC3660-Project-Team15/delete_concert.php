<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Delete concert</title>
</head>

<?php
hd("Deleting Concert");
//
if ( isset($_POST['delete']) && isset($_POST['concert_id']) ) {
    $sql = "delete from CONCERT where concert_id = ".$_GET['concert_id'].";";
    if (mysqli_query($conn, $sql)) {
        echo("concert successfully deleted.");
        concert_link();
    }
    return;
}

// First time we enter delete, we come here. Checks if ID is included and valid.
if (isset($_GET['concert_id'])) {
    $sql = "select * from CONCERT where concert_id = ".$_GET['concert_id'].";";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        // There does exist a concert with the ID. Ask to confirm deletion.
        $row = mysqli_fetch_assoc($result);
        echo("Delete concert ".$row['cdate'].", ".$row['ctime']."?");
    } else {
        // Couldn't find ID in database.
        echo("Error: concert ID is invalid");
        concert_link();
        return;
    }
} else {
    echo("Error: Missing concert ID");
    concert_link();
    return;
}
?>

<form method="post">
<input type="hidden" name="concert_id" value="<?= $row['concert_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="concert.php">Cancel</a>
</form>

</body>
</html>
