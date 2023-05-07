<?php
session_start();

if (!isset($_SESSION["username"])) header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/allenamento.css">
</head>

<body>
    <nav>
      <div class="left">
        <a href="allenamento.php"><span>Allenamento</span></a>
        <a href="progressi.php"><span>Progressi</span></a>
        <a href="profilo.php"><span>Profilo</span></a>
      </div>
      <a href="logut.php"><span>Esci</span></a>
    </nav>
    <div class="content">
        <h2>Progressi</h3>
        <section>

        </section>
    </div>
</body>

</html>