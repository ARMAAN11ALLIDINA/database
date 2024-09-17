<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Edit Concert</title>
</head>


<?php
hd("Updating Ticket");
// DEALING WITH POST
if (isset($_POST['ticket_id']) && isset($_POST['concert_id'])
&& isset($_POST['seat']) && isset($_POST['cost'])) {

    $ticket_id = $_POST['ticket_id'];
    $concert_id = $_POST['concert_id'];
    $seat = $_POST['seat'];
    $cost = $_POST['cost'];

    if (strlen($ticket_id) < 1) {
        // Check if ticket ID is actually there
        echo ("<p>Error: ticket ID not set</p>");

    }

    $sql = "update TICKET set
        concert_id = '$concert_id', seat = '$seat', cost = '$cost'
        where ticket_id = $ticket_id;";

    if (mysqli_query($conn, $sql)) {
        echo ("Ticket successfully updated.");
        ticket_link();
    }
    return;
}

// DEALING WITH GET
if (!isset($_GET['ticket_id'])) {
    echo ("<p>Error missing ticket ID</p>");
    ticket_link();
    return;
}

$ticket_id = $_GET['ticket_id'];
$concert_id = "";
$cost = "";
$seat = "";

$sql = "select * from TICKET where ticket_id = $ticket_id;";
$query = mysqli_query($conn, $sql);
if ($result = mysqli_fetch_assoc($query)) {
    $concert_id = $result['concert_id'];
    $seat = $result['seat'];
    $cost = $result['cost'];

    $sql = "select * from CONCERT;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        echo ("<form method='post'>");
        echo ("<label for='concert_id' >Concert:</label>");
        echo ("<select name='concert_id' id='concert_id'>");
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['concert_id'];
            $cname = $row['cname'];
            $cdate = $row['cdate'];
            $str = $id . ". " . $cname . ", " . $cdate;
            if ($id == $concert_id) {
                echo ("<option value=$id selected>$str</option>");
            }
            else {
                echo ("<option value=$id>$str</option>");
            }
        }
        echo ("</select>");
        echo ("<p>Seat: <input type='text' name='seat' value=$seat></p>");
        echo ("<p>Cost: <input type='text' name='cost' value=$cost></p>");
        echo ("<input type='hidden' name='ticket_id' value=$ticket_id>");
        echo ("<p><input type='submit' value='Update'/>");
        echo ("</form>");
    }
    else {
        echo ("<p> No concerts found. </p>");
    }
}

?>

</body>
</html>
