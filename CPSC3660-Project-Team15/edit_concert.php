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
hd("Updating Concert");
// DEALING WITH POST
if (isset($_POST['concert_id']) && isset($_POST['venue_id'])
&& isset($_POST['cname']) && isset($_POST['cdate']) && isset($_POST['ctime'])) {

    $concert_id = $_POST['concert_id'];
    $venue_id = $_POST['venue_id'];
    $cname = $_POST['cname'];
    $cdate = $_POST['cdate'];
    $ctime = $_POST['ctime'];

    if (strlen($concert_id) < 1) {
        // Check if concert ID is actually there
        echo ("<p>Error: concert ID not set</p>");

    }

    $sql = "update CONCERT set
        venue_id = '$venue_id', cname = '$cname', ctime = '$ctime', cdate = '$cdate'
        where concert_id = $concert_id;";

    if (mysqli_query($conn, $sql)) {
        echo ("concert successfully updated.");
        concert_link();
    }
    return;
}

// DEALING WITH GET
if (!isset($_GET['concert_id'])) {
    echo ("<p>Error missing concert ID</p>");
    concert_link();
    return;
}

$concert_id = $_GET['concert_id'];
$venue_id = "";
$ctime = "";
$cdate = "";
$cname = "";

$sql = "select * from CONCERT where concert_id = $concert_id;";
$query = mysqli_query($conn, $sql);
if ($result = mysqli_fetch_assoc($query)) {
    $venue_id = $result['venue_id'];
    $cname = $result['cname'];
    $ctime = $result['ctime'];
    $cdate = $result['cdate'];

    $sql = "select * from VENUE;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0) {
        echo ("<form method='post'>");
        echo ("<label for='venue_id' >Venue:</label>");
        echo ("<select name='venue_id' id='venue_id'>");
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['venue_id'];
            $vname = $row['vname'];
            $city = $row['city'];
            $str = $id . ". " . $vname . ", " . $city;
            if ($id == $venue_id) {
                echo ("<option value=$id selected>$str</option>");
            }
            else {
                echo ("<option value=$id>$str</option>");
            }
        }
        echo ("</select>");
        echo ("<p>Name: <input type='text' name='cname' value='$cname'></p>");
        echo ("<p>Date: <input type='date' name='cdate' value=$cdate></p>");
        echo ("<p>Time: <input type='time' name='ctime' value=$ctime></p>");
        echo ("<input type='hidden' name='concert_id' value=$concert_id>");
        echo ("<p><input type='submit' value='Update'/>");
        echo ("</form>");
    }
    else {
        echo ("<p> No venues found. </p>");
    }
}

?>

</body>
</html>
