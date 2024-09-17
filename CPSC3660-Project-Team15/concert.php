<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head><title>Concerts</title></head>
<body>

<?php

$str = "";

$sql = "select * from CONCERT as C, VENUE as V
        where C.venue_id=V.venue_id;";
if (isset($_GET['city'])) {
  $city = $_GET['city'];
  $str = " in $city";
  $sql = "select * from CONCERT as C, VENUE as V
          where C.venue_id=V.venue_id and V.city = '$city';";
}

if (isset($_GET['band_id'])) {
  $band_id = $_GET['band_id'];
  $str = " playing Band $band_id";
  $sql = "select * from CONCERT as C, VENUE as V, PLAYS as P
          where C.venue_id=V.venue_id
          and P.concert_id = C.concert_id
          and P.band_id = '$band_id';";
}

hd("Concerts" . $str);

$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    echo('<table>'."\n");
    echo("<tr><th>Concert ID</th>");
    echo("<th>Name</th>");
    echo("<th>Date</th>");
    echo("<th>Time</th>");
    echo("<th>Location</th>");
    echo("<th>Address</th>");
    echo("<th>City</th>");
    echo("<th>Actions</th></tr>");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        td($row['concert_id']);
        td($row['cname']);
        td($row['cdate']);
        td($row['ctime']);
        td($row['vname']);
        td($row['address']);
        td($row['city']);
        echo("<td>");
        echo('<a href="edit_concert.php?concert_id='.$row['concert_id'].'">Edit</a> / ');
        echo('<a href="delete_concert.php?concert_id='.$row['concert_id'].'">Delete</a> / ');
        echo('<a href="ticket.php?concert_id='.$row['concert_id'].'">Tickets</a> / ');
        echo('<a href="concert_band.php?concert_id='.$row['concert_id'].'">Bands</a>');
        echo("</td></tr>\n");
    }
    echo("</table>");
} else {
    echo("<p> No concerts found. </p>");
}
 ?>
<form method="get">
<p>Search by city: <input type="text" name="city">
<input type="submit" value="Search"/></p>
</form>
<p><a href="add_concert.php">Add concert</a></p>

</body>
</html>
