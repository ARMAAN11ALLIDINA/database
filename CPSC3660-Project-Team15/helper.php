<?php
function home_link() {
    echo('<p><a href="concert.php">Home</a></p>');
}

function guest_link() {
    echo('<p><a href="guest.php">Guests</a></p>');
}

function band_link() {
    echo('<p><a href="band.php">Bands</a></p>');
}

function venue_link() {
    echo('<p><a href="venue.php">Venues</a></p>');
}

function concert_link() {
    echo('<p><a href="concert.php">Concerts</a></p>');
}

function ticket_link() {
    echo('<p><a href="ticket.php">Tickets</a></p>');
}

function td($s) {
    echo("<td>".$s."</td>");
}

function th($s) {
    echo("<th>".$s."</th>");
}

function hd($title) {
  echo("<div class='topnav'>");
  echo("<a href='concert.php'>Concerts</a>");
  echo("<a href='venue.php'>Venues</a>");
  echo("<a href='band.php'>Bands</a>");
  echo("<a href='ticket.php'>Tickets</a>");
  echo("<a href='guest.php'>Guests</a></div>");
  echo("<h1><b>$title</b></h1>");
}
?>
