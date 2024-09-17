<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head>
    <title>Guests</title>
</head>


<?php
hd("Guests");
$sql = "select * from GUEST;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

if ($resultCheck > 0) {
    echo('<table>'."\n");
    echo("<tr><th>Guest ID</th>");
    echo("<th>Name</th>");
    echo("<th>Phone</th>");
    echo("<th>Email</th>");
    echo("<th>Actions</th></tr>");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        td($row['guest_id']);
        td($row['name']);
        td($row['phone']);
        td($row['email']);
        echo("<td>");
        echo('<a href="edit_guest.php?guest_id='.$row['guest_id'].'">Edit</a> / ');
        echo('<a href="delete_guest.php?guest_id='.$row['guest_id'].'">Delete</a> / ');
        echo('<a href="guest_ticket.php?guest_id='.$row['guest_id'].'">Tickets</a>');
        echo("</td></tr>\n");
    }
    echo("</table>");
} else {
    echo("<p> There are no guests in the database. </p>");
}
 ?>
<br>
<a href="add_guest.php">Add Guest</a>
<br>
<br>

</body>
</html>
