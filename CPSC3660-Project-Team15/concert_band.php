<?php
include_once 'db.php';
include_once 'helper.php';
include_once 'style.php';
?>

<html>
<head><title>Bands</title></head>

<?php
if (!isset($_GET['concert_id'])) {
    header('Location:concert.php');
    return;
}
$concert_id = $_GET['concert_id'];

if ( isset($_POST['band_id']) ) {
  $band_id = $_POST['band_id'];
  if (isset($_POST['delete'])){
    // DELETING BAND

    $sql = "delete from PLAYS where
            concert_id = '$concert_id' and band_id = '$band_id';";
    if (mysqli_query($conn, $sql)) {
        echo("Band successfully deleted.");
    }
  } else {
    // ADDING BAND
    $sql = "insert into PLAYS (concert_id, band_id)
            values ('$concert_id', '$band_id');";
    if (mysqli_query($conn, $sql)) {
        echo("Band successfully added.");
    }

  }

}


hd("Bands playing at Concert " . $concert_id);

$sql = "select * from BAND as B, PLAYS as P
        where P.concert_id = '$concert_id' and P.band_id = B.band_id;";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
    $bands = array();
    echo ('<table>' . "\n");
    echo ("<tr><th>Band ID</th>");
    echo ("<th>Name</th>");
    echo ("<th>Manager</th>");
    echo ("<th>Phone</th>");
    echo ("<th>Email</th></tr>");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        td($row['band_id']);
        td($row['name']);
        td($row['manager']);
        td($row['phone']);
        td($row['email']);
        echo ("</tr>\n");
        $bands[$row['name']] = $row['band_id'];
    }
    echo ("</table>");

    // DELETING BAND FORM
    // Cannot fetch_assoc again because it depletes the array
    echo ("<form method='post'>");
    echo ("<label for='band_id' >Remove Band: </label>");
    echo ("<select name='band_id' id='band_id'>");
    foreach ($bands as $bname => $bid) {
        $str = $bid . ". " . $bname;
        echo ("<option value=$bid>$str</option>");
    }
    echo ("</select>");
    echo ("<input type='hidden' name='concert_id' value=$concert_id>");
    echo ("<input type='submit' value='Delete' name='delete' class='button'>");
    echo ("</form>");


}
else {
    echo ("<p> This concert doen't have any bands playing yet! </p>");
}

// ADDING BAND FORM
$sql = "select * from BAND as B where not exists
      (select * from PLAYS as P where B.band_id = P.band_id and P.concert_id = '$concert_id')";
$result = mysqli_query($conn, $sql);
if ($result && mysqli_num_rows($result) > 0) {
  echo ("<form method='post'>");
    echo ("<label for='band_id' >Add Band: </label>");
    echo ("<select name='band_id' id='band_id'>");
    while ($row = mysqli_fetch_assoc($result)) {
        $id = $row['band_id'];
        $name = $row['name'];
        $str = $id . ". " . $name;
        echo ("<option value=$id>$str</option>");
    }
    echo ("</select>");
    echo ("<input type='submit' value='Add' class='button'/>");
    echo ("</form>");
}
else {
    echo ("<p> This concert already has all the bands. Wow. </p>");
}

?>


</body>
</html>
