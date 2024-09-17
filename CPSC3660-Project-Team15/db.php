<?php

// VVV IMPORTANT: IF ON SCHOOL COMPUTERS, SET TO TRUE VVV
$at_school = true;

// Enter this block if you come from login screen
if (isset($_POST["username"]) && isset($_POST["password"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  echo "<p>the username is $username and the password is $password</p>";

  setcookie("username",$username,time()+3600);
  setcookie("password",$password,time()+3600);

  header('Location:concert.php');
  return;
}

if (!(isset($_COOKIE["username"]) || isset($_COOKIE["password"]))) {
  header('Location:index.php');
  return;
} else {
  $server_name = "localhost";
  $username = $_COOKIE["username"];
  $password = $_COOKIE["password"];
  $database_name = "conman";
  if ($at_school) {
    $server_name = "vconroy.cs.uleth.ca";
    $database_name = $username;
  }

  $conn = mysqli_connect($server_name, $username, $password, $database_name);

  if($conn->connect_errno)
  {
     echo "Connection Issue!";
  }
}

 ?>
