<?php
session_start();
require_once("backend/model/ModelAttempts.php");

if (isset($_SESSION["admin"]) && !isset($_GET["user"])) {
  header("Location: admin.php");
  exit;
}

if (isset($_GET['user'])){
  $user = $_GET['user'];
} else if (isset($_SESSION["user"])) {
  $user = $_SESSION["user"];
} else if (isset($_SESSION["admin"])) {
  $user = $_SESSION["admin"];
} else {
  header("Location: index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/progressi.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <nav>
    <div class="left">
        <?php

        if (isset($_SESSION["user"])){
          ?>
          <a href="allenamento.php"><span>Allenamento</span></a>
          <a href="progressi.php"><span>Progressi</span></a>
          <?php
        } else if (isset($_SESSION["admin"])){
          ?>
          <a href="admin.php"><span>Admin</span></a>
          <?php
        }
        ?>
        <a href="profilo.php"><span>Profilo</span></a>
      </div>
      <a href="logout.php"><span>Esci</span></a>
    </nav>
    <div class="content">
        <h1>Progressi</h1>
        <table>
          <tr>
            <th>Tempo impiegato</th>
            <th>Livello</th>
            <th>Testo</th>
            <th>Data</th>
            <th>Passato</th>
          </tr>
          <?php
          $attempts = ModelAttempts::get_attempts($user);
          foreach($attempts as $attempt) {
            echo "<tr>";
            echo "<td>".$attempt["time_elapsed"]."</td>";
            echo "<td>".$attempt["level"]."</td>";
            echo "<td>".$attempt["idText"]."</td>";
            echo "<td>".$attempt["dateAttempt"]."</td>";
            echo "<td>".($attempt["passed"] ? "<i class='fas fa-check'></i>" : "<i class='fas fa-xmark'></i>")."</td>";
            echo "</tr>";
          }
          ?>
        </table>
    </div>
</body>

</html>