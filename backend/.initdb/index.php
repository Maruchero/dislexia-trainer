<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dislexia-trainer";

$conn = new mysqli($servername, $username, $password);
mysqli_set_charset($conn, "utf8");

if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
}

$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database dislexia-trainer creato con successo\n";
} else {
    echo "Errore nella creazione del database: " . $conn->error;
}

$conn->select_db($dbname);

$sql = "CREATE TABLE `users` (
      `username` varchar(255) PRIMARY KEY,
      `password` varchar(255) NOT NULL,
      `name` varchar(255) NOT NULL,
      `surname` varchar(255) NOT NULL,
);";

if ($conn->query($sql) === TRUE) {
  echo "Tabella users creata con successo\n";
} else {
  echo "Errore nella creazione della tabella users: " . $conn->error;
}

$sql = "CREATE TABLE `texts` (
      `idText` char(5) PRIMARY KEY,
      `text` TEXT NOT NULL,
      `level` INT NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabella texts creata con successo\n";
} else {
    echo "Errore nella creazione della tabella texts: " . $conn->error;
}

$sql = "CREATE TABLE `attempts` (
      `idAttempt` char(5) PRIMARY KEY,
      `username` varchar(255),
      `idText` char(5),
      FOREIGN KEY(`username`) REFERENCES `users`(`username`),
      FOREIGN KEY(`idText`) REFERENCES `texts`(`idText`),
      `dateAttempt` DATE NOT NULL,
      `time_elapsed` DOUBLE NOT NULL,
      `passed` BOOLEAN NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabella attempt creata con successo\n";
} else {
    echo "Errore nella creazione della tabella attempt: " . $conn->error;
}
