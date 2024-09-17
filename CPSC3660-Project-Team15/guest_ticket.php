<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head><title>Tickets</title></head>

<?php
if (!isset($_GET['guest_id'])) {
    header('Location:guest.php');
    return;
}
$guest_id = $_GET['guest_id'];

if ( isset($_POST['ticket_id']) ) {
  $ticket_id = $_POST['ticket_id'];
  if (isset($_POST['delete'])){
    // DELETING ticket

    $sql = "delete from HOLDS where
            guest_id = '$guest_id' and ticket_id = '$ticket_id';";
    if (mysqli_query($conn, $sql)) {
        echo("ticket successfully deleted.");
    }
  } else {
    // ADDING ticket
    $sql = "insert into HOLDS (guest_id, ticket_id)
            values ('$guest_id', '$ticket_id');";
    if (mysqli_query($conn, $sql)) {
        echo("Ticket added to guest's inventory.");
    }

  }

}

hd("Guest " . $guest_id . "'s Tickets");

$sql = "select * from TICKET as T, HOLDS as H
        where H.guest_id = '$guest_id' and T.ticket_id = H.ticket_id;";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $tickets = array();
    echo ('<table>' . "\n");
    echo ("<tr><th>Ticket ID</th>");
    echo ("<th>Seat</th>");
    echo ("<th>Cost</th></tr>");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        td($row['ticket_id']);
        td($row['seat']);
        td($row['cost']);
        echo ("</tr>\n");
        $tickets[$row['seat']] = $row['ticket_id'];
    }
    echo ("</table>");

    // DELETING ticket FORM
    // Cannot fetch_assoc again because it depletes the array
    echo ("<form method='post'>");
    echo ("<label for='ticket_id' >Remove ticket: </label>");
    echo ("<select name='ticket_id' id='ticket_id'>");
    foreach ($tickets as $tseat => $tid) {
        $str = $tid . ". " . $tseat;
        echo ("<option value=$tid>$str</option>");
    }
    echo ("</select>");
    echo ("<input type='hidden' name='guest_id' value=$guest_id>");
    echo ("<input type='submit' value='Delete' name='delete' class='button'>");
    echo ("</form>");


}
else {
    echo ("<p> This guest doesn't have any tickets yet! </p>");
}

// ADDING ticket FORM
// Need to make sure that you cannot add a ticket that is already being held
$sql = "select * from TICKET as T where not exists
(select * from HOLDS as H where T.ticket_id = H.ticket_id)";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
  echo ("<form method='post'>");
    echo ("<label for='ticket_id' >Add ticket: </label>");
    echo ("<select name='ticket_id' id='ticket_id'>");
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['ticket_id'];
        $seat = $row['seat'];
        $str = $id . ". " . $seat;
        echo ("<option value=$id>$str</option>");
    }
    echo ("</select>");
    echo ("<input type='submit' value='Add' class='button'/>");
    echo ("</form>");
}
else {
    echo ("<p> There are no more available tickets. </p>");
}

?>


</body>
</html>
