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
  function main($username=null, $password=null, $confirm_password=null, $name=null, $surname=null){
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
      <h1 class="title">Inserisci utente</h1>
      <form action="inserisci_utenti.php" method="POST">
        <label for="username">Username *</label>
        <input type="text" name="username" value="<?php echo $username ?>" pattern="^[a-zA-Z0-9]{5}$" required title="Inserisci un username di 5 caratteri alfanumerici">

        <label for="password">Password *</label>
        <input type="password" name="password" value="<?php echo $password ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" required title="La password deve contenere almeno 8 caratteri, di cui almeno una lettera maiuscola, una lettera minuscola, un numero e un carattere speciale">

        <label for="confirm_password">Conferma password *</label>
        <input type="password" name="confirm_password" value="<?php echo $confirm_password ?>" required data-equals="password" title="Le password non corrispondono">

        <label for="name">Name *</label>
        <input type="text" name="name" value="<?php echo $name ?>" pattern="^[a-zA-Z]{2,64}$" required title="Inserisci il tuo nome, senza numeri o caratteri speciali">

        <label for="surname">Surname *</label>
        <input type="text" name="surname" value="<?php echo $surname ?>" pattern="^[a-zA-Z]{2,64}$" required title="Inserisci il tuo cognome, senza numeri o caratteri speciali">
              
        <input type="submit" name="button" class="form-btn" value="Inserisci">
      </form>

    </div>
    <?php
  }

  session_start();
  if (isset($_SESSION["admin"])){
    if (isset($_POST["button"])){
      $username = $_POST["username"];
      $password = $_POST["password"];
      $confirm_password = $_POST["confirm_password"];
      $name = $_POST["name"];
      $surname = $_POST["surname"];
      $role = "User";
      
      $query = "SELECT * FROM users WHERE username='$username'";
      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) == 1) {
        main($username, $password, $confirm_password, $name, $surname);
        echo("Nome utente già presente nel database. Usare un nome utente diverso");
      } else {
        if (strlen($password) >= 8 && $password == $confirm_password) {
          $user_row = ModelUsers::create_user($username, $password, $name, $surname, $role);
          header("Location: admin.php");
        } else {
          main($username, $password, $confirm_password, $name, $surname);
          echo("Le due password non concidono");
        }
      }

    } else {
      main($_SESSION["admin"]);
    } 
  } else {
      header("Location: index.php");
  }
  ?>

</body>

</html>