<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profilo</title>

  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/profilo.css">
  
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
        <?php
        if (isset($_SESSION["user"])){
        ?>
          <a href="allenamento.php"><span>Allenamento</span></a>
          <a href="progressi.php"><span>Progressi</span></a>
        <?php 
        }
        if (isset($_SESSION["admin"])){
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
      <h1 class="title">Profilo utente</h1>
      <?php
        require_once("backend/connect.php");
        
        $query = "SELECT *
                  FROM users 
                  WHERE username = '$username'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $username = $row["username"];
            $password = $row["password"];
            $name = $row["name"];
            $surname = $row["surname"];
            // $role = $row["role"];
        }
        $conn->close();

        echo ("<table>
                <tr><td>Nome utente:</td><td>" . $username . "</td></tr>
                <tr><td>Password:</td><td>" . str_repeat("•", 8) . "</td></tr>
                <tr><td>Nome:</td><td>" . $name . "</td></tr>
                <tr><td>Cognome:</td><td>" . $surname . "</td></tr>
              </table>");
      ?>
      <button type="submit" name="update" type="button"> <a href='modifica_utente.php?mode=update_user'>Modifica</a></button>

    </div>
  <?php
  }

  session_start();
  if (isset($_SESSION["user"])){
    main($_SESSION["user"]);
  } else if (isset($_SESSION["admin"])){
    main($_SESSION["admin"]);
  } else {
      header("Location: index.php");
  }
  ?>

</body>

</html>