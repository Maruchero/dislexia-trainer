<?php
require_once("backend/model/ModelUsers.php");
?>

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

  function update_user($usernameU){
    $user_row = ModelUsers::get_user($usernameU);
    ?>
    <div class="content">
      <h1 class="title">Modifica utente</h1>
      <form method="POST">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo $user_row['username'] ?>" required disabled>

        <label for="password">Password attule</label>
        <input type="password" name="password_attule" required>

        <label for="password">Nuova password</label>
        <input type="password" name="nuvova_password" required>

        <label for="password">Conferma password</label>
        <input type="password" name="conferma_password" required>

        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo $user_row['name'] ?>" required>

        <label for="surname">Surname</label>
        <input type="text" name="surname" value="<?php echo $user_row['surname'] ?>" required>
        
        <input type="submit" name="modify_button" class="form-btn" value="Modifica">
      </form>
    </div>
    <?php
  }

  session_start();
  if ((isset($_SESSION["user"]) || isset($_SESSION["admin"])) && isset($_GET['mode'])) {
    
    if (isset($_SESSION["user"])) {
      $usernameS = $_SESSION["user"];
    } else if (isset($_SESSION["admin"])) {
      $usernameS = $_SESSION["admin"];
    }



    if (!isset($_POST["password"])) die("Missing parameter 'password'");
    $usernameU = $_POST["username"];
    $password = $_POST["password"];

    if ($usernameS == $usernameU) {

      $sql = "SELECT *
              FROM users
              WHERE username = '$usernameU' AND password = '$password'";

      $result = mysqli_query($conn, $sql);

      if (mysqli_num_rows($result) == 1) {
        if (isset($_POST["modify_button"])) {

          if (!isset($_POST["username"])) die("Missing parameter 'username'");
          if (!isset($_POST["password"])) die("Missing parameter 'password'");
          if (!isset($_POST["name"])) die("Missing parameter 'name'");
          if (!isset($_POST["surname"])) die("Missing parameter 'surname'");
    
          $usernameU = $_POST["username"];
          $password = $_POST["password"];
          $name = $_POST["name"];
          $surname = $_POST["surname"];
          
          require_once("backend/model/ModelUsers.php");
          ModelUsers::update_user($usernameU, $password, $name, $surname);
          header("Location: profilo.php");
          
        } else {
          $mode = $_GET["mode"];
          
          if (isset($_GET["username"])){
            $username_U = $_GET["username"];
          }
          
          switch ($mode) {
    
              case 'delete_user':
                if (!isset($username_U)) die("Missing parameter 'username'");
                require_once("backend/model/ModelUsers.php");
                ModelUsers::delete_user($username_);
                header("Location: index.php");
                break;
            
              case 'update_user':
                if (isset($username_U)){
                  update_user($username_U);
                } else if (isset($_SESSION["user"])){
                  update_user($_SESSION["user"]);
                } else if (isset($_SESSION["admin"])){
                  update_user($_SESSION["admin"]);
                }
                break;
            }
        }

      } else {
        echo ("Password errata");
      }
        
      } else {
        echo ("Nome utente diverso dall'utente attuale");
      }
      
    
    
    
  } else {
      header("Location: index.php");
  }
  ?>

</body>

</html>