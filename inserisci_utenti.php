<?php
session_start();
require_once("backend/model/ModelUsers.php");

if (isset($_SESSION["user"])) {
  header("Location: allenamento.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inserisci utente</title>

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
  function main($usernameU=null, $password=null, $confirm_password=null, $name=null, $surname=null){
    global $errors;
    ?>
    <nav>
      <div class="left">
        <a href="admin.php"><span>Admin</span></a>
        <a href="profilo.php"><span>Profilo</span></a>
      </div>
      <a href="logout.php"><span>Esci</span></a>
    </nav>

    <div class="content">
      <h1 class="title">Inserisci utente</h1>
      <form action="inserisci_utenti.php" method="POST">
        <label for="username">Username *</label>
        <input type="text" name="username" value="<?php echo $usernameU ?>" pattern="^[a-zA-Z0-9]{5,}$" required title="Inserisci un username di almeno 5 caratteri alfanumerici">
        <span class="error"><?php if (isset($errors["username"])) {echo $errors["username"];} ?></span>

        <label for="password">Password *</label>
        <input type="password" name="password" value="<?php echo $password ?>" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*\W).{8,}" required title="La password deve contenere almeno 8 caratteri, di cui almeno una lettera maiuscola, una lettera minuscola, un numero e un carattere speciale">
        <span class="error"><?php if (isset($errors["password"])) {echo $errors["password"];} ?></span>

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

  $errors = [];
  if (isset($_POST["button"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $role = "User";
    
    $query = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $query);

    // Check errors
    if (mysqli_num_rows($result) == 1)
      $errors["username"] = "Nome utente già presente nel database. Usare un nome utente diverso";
    if ($password != $confirm_password)
      $errors["password"] = "Le due password non concidono";
    
    // If everything went good
    if ($errors) {
      main($username, $password, $confirm_password, $name, $surname);
    } else {
      $user_row = ModelUsers::create_user($username, password_hash($password, PASSWORD_DEFAULT), $name, $surname, $role);
      header("Location: admin.php");
    }

  } else {
    main();
  }
  ?>

</body>

</html>