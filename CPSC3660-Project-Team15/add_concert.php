<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head><title>Add Concert</title></head>

<body>

<?php
hd("Adding Concert");
if (isset($_POST['venue_id']) && isset($_POST['cname'])
&& isset($_POST['ctime']) && isset($_POST['cdate'])) {

    $venue_id = $_POST['venue_id'];
    $cname = $_POST['cname'];
    $cdate = $_POST['cdate'];
    $ctime = $_POST['ctime'];
    $sql = "insert into CONCERT (venue_id, cname, ctime, cdate)
            values ('$venue_id', '$cname', '$ctime', '$cdate');";

    if (mysqli_query($conn, $sql)) {
        echo ("Concert successfully added.");
        concert_link();
    }
    return;
}
?>

<form method="post">
<?php
$sql = "select * from VENUE;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    echo ("<label for='venue_id' >Venue: </label>");
    echo ("<select name='venue_id' id='venue_id'>");
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['venue_id'];
        $vname = $row['vname'];
        $city = $row['city'];
        $str = $id . ". " . $vname . ", " . $city;
        echo ("<option value=$id>$str</option>");
    }
    echo ("</select>");
    echo ("<p>Name: <input type='text' name='cname'></p>");
    echo ("<p>Time: <input type='time' name='ctime'></p>");
    echo ("<p>Date: <input type='date' name='cdate'></p>");
    echo ("<input type='submit' value='Add New' class='button'/>");
    echo("</form>");
}
else {
    echo ("<p> No venues found. </p>");
}
?>
<form action="concert.php">
    <input type="submit" value="Cancel" class="button button2"/>
</form>

</body>
</html>
