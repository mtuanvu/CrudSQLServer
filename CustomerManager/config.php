<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$dbname = "customermanager";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error connecting to" . $conn->connect_error);
}
