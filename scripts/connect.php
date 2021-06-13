<?php
$servername= "localhost";
$username= "root";
$password= "";
$basename= "projekt";

// Create connection
$dbc= mysqli_connect($servername, $username, $password, $basename, '8111') or die('Error connectingto MySQL server.'.mysqli_error());
mysqli_set_charset($dbc, "utf8");

?>