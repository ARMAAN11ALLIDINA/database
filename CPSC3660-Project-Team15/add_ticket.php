<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head><title>Add ticket</title></head>

<body>

<?php
hd("Adding Ticket");
if (isset($_POST['concert_id']) && isset($_POST['seat']) && isset($_POST['cost'])) {

    $concert_id = $_POST['concert_id'];
    $seat = $_POST['seat'];
    $cost = $_POST['cost'];
    $sql = "insert into TICKET (concert_id, cost, seat)
            values ('$concert_id', '$cost', '$seat');";

    if (mysqli_query($conn, $sql)) {
        echo ("Ticket successfully added.");
        ticket_link();
    }
    return;
}
?>

<form method="post">
<?php
$sql = "select * from CONCERT as C, VENUE as V where C.venue_id = V.venue_id;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    echo ("<label for='concert_id' >Concert:</label>");
    echo ("<select name='concert_id' id='concert_id'>");
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['concert_id'];
        $cname = $row['cname'];
        $cdate = $row['cdate'];
        $vname = $row['vname'];
        $str = $id . ". " . $cname. " at " .  $cdate . ", " . $vname;
        echo ("<option value=$id>$str</option>");
    }
    echo ("</select>");
    echo ("<p>Cost: <input type='text' name='cost'></p>");
    echo ("<p>Seat: <input type='text' name='seat'></p>");
    echo ("<p><input type='submit' value='Add New'/>");
    echo ("</form>");
}
else {
    echo ("<p> No concerts found. </p>");
}
?>
<a href="ticket.php">Cancel</a></p>


</body>
</html>
