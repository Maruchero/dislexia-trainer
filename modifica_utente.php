<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Allenamento</title>

  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/modifica_utente.css">
  
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
    if (isset($_SESSION["user"])){
    ?>
    <nav>
    <div class="left">
      <?php
        if (isset($_SESSION["user"])){
          ?>
          <a href="allenamento.php"><span>Allenamento</span></a>
          <a href="progressi.php"><span>Progressi</span></a>
          <?php 
        }
        ?>
        <a href="profilo.php"><span>Profilo</span></a>
      </div>
      <a href="logout.php"><span>Esci</span></a>
    </nav>
    <?php
    }
    ?>

    <div class="content">
      <?php

      function update_user($username){
        require_once ("backend/connect.php");
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result); 
        $conn->close();

        ?>
        <h1 class="title">Modifica utente</h1>
        <form method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" value="<?php echo $row['username'] ?>" Required>

            <label for="password">Password</label>
            <input type="password" name="password" value="<?php echo $row['password'] ?>" Required>

            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo $row['name'] ?>" Required>

            <label for="surname">Surname</label>
            <input type="text" name="surname" value="<?php echo $row['surname'] ?>" Required>
            
            <input type="submit" name="modify_button" class="form-btn" value="Modifica">
        </form>
        <?php
      }
      ?>
    </div>
  <?php
  }

  session_start();
  if ((isset($_SESSION["user"]) || isset($_SESSION["admin"])) && isset($_GET['mode'])){
    main();
    
    if (isset($_POST["modify_button"])){

      if (!isset($_POST["username"])) die("Missing parameter 'username'");
      if (!isset($_POST["password"])) die("Missing parameter 'password'");
      if (!isset($_POST["name"])) die("Missing parameter 'name'");
      if (!isset($_POST["surname"])) die("Missing parameter 'surname'");

      $username = $_POST["username"];
      $password = $_POST["password"];
      $name = $_POST["name"];
      $surname = $_POST["surname"];
      
      
      require_once("backend/model/ModelUsers.php");
      ModelUsers::update_user($username, $password, $name, $surname);
      header("Location: profilo.php");
      
    } else {
      $mode = $_GET["mode"];
      
      if (isset($_GET["username"])){
        $username_ = $_GET["username"];
      }
      
      switch ($mode) {

          case 'delete_user':
            if (!isset($username_)) die("Missing parameter 'username'");
            require_once("backend/model/ModelUsers.php");
            ModelUsers::delete_user($username_);
            header("Location: index.php");
            break;
        
          case 'update_user':
            if (isset($username_)){
              update_user($username_);
            } else if (isset($_SESSION["user"])){
              update_user($_SESSION["user"]);
            } else if (isset($_SESSION["admin"])){
              update_user($_SESSION["admin"]);
            }
            break;
        }
    }
    
  } else {
      header("Location: index.php");
  }
  ?>

</body>

</html>