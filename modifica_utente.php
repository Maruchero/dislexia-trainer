<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Allenamento</title>

  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/modifica_utente.css">
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
  <?php
  function main(){
    ?>
    <nav>
      <div class="left">
        <a href="allenamento.php"><span>Allenamento</span></a>
        <a href="progressi.php"><span>Progressi</span></a>
        <a href="profilo.php"><span>Profilo</span></a>
      </div>
      <a href="logout.php"><span>Esci</span></a>
    </nav>

    <div class="content">
      <?php

      function modify_user($username){
        include "backend/connect.php";
        $sql = "SELECT * FROM users WHERE username='$username'";
        $qry = mysqli_query($conn, $sql);
        $data = mysqli_fetch_array($qry); 
        ?>
        <h1 class="title">Modifica utente</h1>
        <form method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $data['username'] ?>" Required>

            <label for="password">Password</label>
            <input type="password" name="id_film" value="<?php echo $data['password'] ?>" Required>

            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $data['name'] ?>" Required>

            <label for="surname">Surname</label>
            <input type="text" name="surname" value="<?php echo $data['surname'] ?>" Required>
            
            <input type="submit" name="modify_button" class="form-btn" value="Modifica">
        </form>
        <?php
      }
      ?>
    </div>
  <?php
  }

  session_start();
  if (isset($_SESSION["username"]) && isset($_GET['mode'])){
    main();
    
    if (isset($_POST["modify_button"])){
      // Chiamata API ControllerUsers?mode=modify_user
      
    } else {
      $mode = $_GET["mode"];
      switch ($mode) {

          case 'delete_user':
            // Chiamata API ControllerUsers?mode=delete_user
            break;
        
          case 'modify_user':
              modify_user($_SESSION["username"]);  
            break;
        }
    }
    
  } else {
      header("Location: index.php");
  }
  ?>

</body>

</html>