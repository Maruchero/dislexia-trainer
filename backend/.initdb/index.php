<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dislexia_trainer";

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

$sql = "CREATE TABLE IF NOT EXISTS `users` (
      `username` VARCHAR(255) PRIMARY KEY,
      `password` VARCHAR(255) NOT NULL,
      `name` VARCHAR(255) NOT NULL,
      `surname` VARCHAR(255) NOT NULL
);";

if ($conn->query($sql) === TRUE) {
  echo "Tabella users creata con successo\n";
} else {
  echo "Errore nella creazione della tabella users: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS `texts` (
      `idText` CHAR(5) PRIMARY KEY,
      `text` TEXT NOT NULL,
      `level` INT NOT NULL
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabella texts creata con successo\n";
} else {
    echo "Errore nella creazione della tabella texts: " . $conn->error;
}

$sql = "CREATE TABLE IF NOT EXISTS `attempts` (
      `idAttempt` CHAR(5) PRIMARY KEY,
      `username` VARCHAR(255),
      `idText` CHAR(5),
      `dateAttempt` DATE NOT NULL,
      `time_elapsed` DOUBLE NOT NULL,
      `passed` BOOLEAN NOT NULL,
      FOREIGN KEY(`username`) REFERENCES `users`(`username`),
      FOREIGN KEY(`idText`) REFERENCES `texts`(`idText`)
);";

if ($conn->query($sql) === TRUE) {
    echo "Tabella attempt creata con successo\n";
} else {
    echo "Errore nella creazione della tabella attempt: " . $conn->error;
}
