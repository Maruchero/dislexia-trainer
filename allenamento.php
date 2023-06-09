<?php
session_start();
if (isset($_SESSION["admin"])) header("Location: admin.php");
if (!isset($_SESSION["user"])) header("Location: index.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Allenamento</title>

  <script>
    <?php
    echo "const username = '" . $_SESSION["user"] . "';";
    ?>
  </script>

  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/allenamento.css">
  <script src="js/ajax.js"></script>
  <script src="js/allenamento.js" defer></script>
  
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
        <a href="allenamento.php"><span>Allenamento</span></a>
        <a href="progressi.php"><span>Progressi</span></a>
        <a href="profilo.php"><span>Profilo</span></a>
      </div>
      <a href="logout.php"><span>Esci</span></a>
    </nav>

    <div class="content">
      <h1 class="title">Livello <span id="titleLevel">1</span></h1>
      <div class="info">
        <i class="fa-solid fa-info-circle"></i>
        <div class="caption">Benvenuto su Dislexia Trainer!
Per il corretto funzionamento dell'applicazione ricordati di scandire bene le parole e di trovarti in un'ambiente silenzioso.

Il nostro obiettivo è quello di aiutarti a migliorare nella lettura di frasi e parole che diventano sempre più complicate ogni livello che passi.
Per salire di livello devi fare almeno 7 tentativi per ogni livello e di questi 7, almeno 5 tentativi devono essere corretti.

E adesso divertiti a leggere con Dislexia Trainer</div>
      </div>

      <div class="relative">
        <div class="result" id="result">
          <span id="time"></span>
          <button onclick="nextSentence()" id="nextSentenceButton">Cominciamo <i class="fa-solid fa-play"></i></button>
        </div>
        <span class="text-indicator"></span>
        <div id="text"></div>
      </div>

      <div class="buttons">
        <button class="restart" id="restartButton" onclick="resetSentence()"><i class="fa-solid fa-arrow-rotate-right"></i></button>
        <button class="record-button" id="recordButton"><i class="fa-solid fa-microphone"></i></button>
      </div>
    </div>

</body>

</html>