<?php
$servername = "localhost:3305";
$username = "root";
$password = "";
$database = 'bibliotheek_app';

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>