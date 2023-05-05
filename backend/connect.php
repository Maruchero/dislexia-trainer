<?php
$servername_ = "localhost";
$username_ = "root";
$password_ = "";
$dbname_ = "dislexia_trainer";

// Connection to mysql server
$conn = new mysqli($servername_, $username_, $password_, $dbname_);
mysqli_set_charset($conn, "utf8");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}
