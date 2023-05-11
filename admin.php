<?php
require_once("backend/model/ModelUsers.php");
session_start();
if (!isset($_SESSION["admin"])) header("Location: allenamento.php");
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
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
        
</head>

<body>
  <?php
  function main($username){
    ?>
    <nav>
      <div class="left">
        <a href="admin.php"><span>Admin</span></a>
        <a href="profilo.php"><span>Profilo</span></a>
      </div>
      <a href="logout.php"><span>Esci</span></a>
    </nav>

    <div class="content">
      <h1 class="title">Utenti</h1>

      <a class='insert-users' href='inserisci_utenti.php'>Registra nuovo utente</a>

      <div class="table-container">
        <table>
          <tr>
              <th>Nome utente</th>
              <th>Nome</th>
              <th>Cognome</th>
              <th>Ruolo</th>
              <th></th>
              <th></th>
          </tr>
          <tbody>
          <?php
          $users = ModelUsers::get_all_users();
          foreach ($users as $user) {
              $username = $user["username"];
              $password = $user["password"];
              $name = $user["name"];
              $surname = $user["surname"];
              $role = $user["role"];
          ?>
            <tr>
                <td><?php echo $username; ?></td>
                <td><?php echo $name; ?></td>
                <td><?php echo $surname; ?></td>
                <td><?php echo $role; ?></td>
                <td><?php if ($role !== "Admin") echo "<a class='progress' href='progressi.php?user=" . $username . "'>Progressi <i class='fa-solid fa-up-right-from-square'></i></a>"; ?></td>
                <td><button type="button"><?php if ($role !== "Admin") echo  "<a href='modifica_utente.php?mode=delete_user&username=" . $username . "' ><i class='fa-solid fa-trash-can'></i></a>"; ?></button></td>
            </tr>
          <?php }
          ?>
          </tbody>
        </table>
      </div>
    </div>
  <?php
  }

  main($_SESSION["admin"]);
  ?>

</body>

</html>