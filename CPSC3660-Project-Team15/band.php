<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Bands</title>
</head>


<?php
hd("Bands");
$sql = "select * from BAND;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    echo('<table>'."\n");
    echo("<tr><th>Band ID</th>");
    echo("<th>Name</th>");
    echo("<th>Manager</th>");
    echo("<th>Phone</th>");
    echo("<th>Email</th>");
    echo("<th>Actions</th></tr>");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        td($row['band_id']);
        td($row['name']);
        td($row['manager']);
        td($row['phone']);
        td($row['email']);
        echo("<td>");
        echo('<a href="edit_band.php?band_id='.$row['band_id'].'">Edit</a> / ');
        echo('<a href="delete_band.php?band_id='.$row['band_id'].'">Delete</a> / ');
        echo('<a href="concert.php?band_id='.$row['band_id'].'">Concerts</a>');
        echo("</td></tr>\n");
    }
    echo("</table>");
} else {
    echo("<p> There are no bands in the database. </p>");
}
 ?>
<br>
<a href="add_band.php">Add band</a>
<br>
<br>

</body>
</html>
