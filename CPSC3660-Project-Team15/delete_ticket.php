<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Delete Ticket</title>
</head>


<?php
hd("Deleting Ticket");
//
if ( isset($_POST['delete']) && isset($_POST['ticket_id']) ) {
    $sql = "delete from TICKET where ticket_id = ".$_GET['ticket_id'].";";
    if (mysqli_query($conn, $sql)) {
        echo("ticket successfully deleted.");
        ticket_link();
    }
    return;
}

// First time we enter delete, we come here. Checks if ID is included and valid.
if (isset($_GET['ticket_id'])) {
    $sql = "select * from TICKET as T, CONCERT as C where
    ticket_id = ".$_GET['ticket_id']." and T.concert_id = C.concert_id;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        // There does exist a ticket with the ID. Ask to confirm deletion.
        $row = mysqli_fetch_assoc($result);
        echo("Delete ticket ".$row['cdate'].", ".$row['ctime']."?");
    } else {
        // Couldn't find ID in database.
        echo("Error: ticket ID is invalid");
        ticket_link();
        return;
    }
} else {
    echo("Error: Missing ticket ID");
    ticket_link();
    return;
}
?>

<form method="post">
<input type="hidden" name="ticket_id" value="<?= $row['ticket_id'] ?>">
<input type="submit" value="Delete" name="delete">
<a href="ticket.php">Cancel</a>
</form>

</body>
</html>
