<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>



<html>
<head><title>Tickets</title></head>

<body>

<?php
hd("Tickets");
$sql = "select * from TICKET as T, CONCERT as C, VENUE as V
        where T.concert_id = C.concert_id and C.venue_id=V.venue_id;";
if (isset($_GET['concert_id'])) {
  $concert_id = $_GET['concert_id'];
  $sql = "select * from TICKET as T, CONCERT as C, VENUE as V
          where T.concert_id = C.concert_id and C.venue_id=V.venue_id and T.concert_id = '$concert_id';";
}

$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    echo('<table>'."\n");
    echo("<tr><th>Ticket ID</th>");
    echo("<th>Seat</th>");
    echo("<th>Cost</th>");
    echo("<th>Concert</th>");
    echo("<th>Date</th>");
    echo("<th>Time</th>");
    echo("<th>Location</th>");
    echo("<th>Actions</th>");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        td($row['ticket_id']);
        td($row['seat']);
        td($row['cost']);
        td($row['cname']);
        td($row['cdate']);
        td($row['ctime']);
        td($row['vname']);
        echo("<td>");
        echo('<a href="edit_ticket.php?ticket_id='.$row['ticket_id'].'">Edit</a> / ');
        echo('<a href="delete_ticket.php?ticket_id='.$row['ticket_id'].'">Delete</a>');
        echo("</td></tr>\n");
    }
    echo("</table>");
} else {
    echo("<p> No tickets found. </p>");
}
 ?>
<p><a href="add_ticket.php">Add ticket</a></p>

</body>
</html>
