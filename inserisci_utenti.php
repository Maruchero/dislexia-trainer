<?php
require_once("backend/model/ModelUsers.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>

  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/admin.css">
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
    ?>
    <nav>
      <div class="left">
        <a href="admin.php"><span>Admin</span></a>
        <a href="inserisci_utenti.php"><span>Inserisci utenti</span></a>
        <a href="profilo.php"><span>Profilo</span></a>
      </div>
      <a href="logout.php"><span>Esci</span></a>
    </nav>

    <div class="content">
      <h1 class="title">Modifica utente</h1>
      <form action="inserisci_utenti.php" method="POST">
        <label for="username">Username *</label>
        <input type="text" name="username" required>

        <label for="password">Password *</label>
        <input type="password" name="password" required>

        <label for="confirm_password">Conferma password *</label>
        <input type="password" name="confirm_password">

        <label for="name">Name *</label>
        <input type="text" name="name" required>

        <label for="surname">Surname *</label>
        <input type="text" name="surname" required>
        
        <input type="submit" name="button" class="form-btn" value="Modifica">
      </form>
    </div>
    <?php
  }

  session_start();
  if (isset($_SESSION["admin"])){
    if (isset($_POST["button"])){
      echo ($_POST["username"]);
      $username = $_POST["username"];
      $password = $_POST["password"];
      $name = $_POST["name"];
      $surname = $_POST["surname"];
      $role = "User";

      $user_row = ModelUsers::create_user($username, $password, $name, $surname, $role);
    } else {
      main($_SESSION["admin"]);
    } 
  } else {
      header("Location: index.php");
  }
  ?>

</body>

</html>