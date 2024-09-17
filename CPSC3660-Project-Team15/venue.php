<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head><title>Venues</title></head>

<body>

<?php
hd("Venues");
$sql = "select * from VENUE;";
if (isset($_GET['city'])) {
  $city = $_GET['city'];
  $sql = "select * from VENUE where city = '$city';";
}

$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    echo('<table>'."\n");
    echo("<tr><th>Venue ID</th>");
    echo("<th>Name</th>");
    echo("<th>Address</th>");
    echo("<th>City</th>");
    echo("<th>Capactiy</th>");
    echo("<th>Actions</th></tr>");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        td($row['venue_id']);
        td($row['vname']);
        td($row['address']);
        td($row['city']);
        td($row['seats']);
        echo("<td>");
        echo('<a href="edit_venue.php?venue_id='.$row['venue_id'].'">Edit</a> / ');
        echo('<a href="delete_venue.php?venue_id='.$row['venue_id'].'">Delete</a>');
        echo("</td></tr>\n");
    }
    echo("</table>");
} else {
    echo("<p> No venues found. </p>");
}
 ?>
<form method="get">
<p>Search by City: <input type="text" name="city">
<input type="submit" value="Search"/></p>
</form>
<p><a href="add_venue.php">Add venue</a></p>

</body>
</html>
