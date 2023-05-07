<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Allenamento</title>

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
    <div class="">
      <h1 class="title">Utenti</h1>
      <table>
        <tr>
            <th>Nome utente</th>
            <th>Password</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Ruolo</th>
            <th>Elimina</th>
            <th>Modifica</th>

        </tr>
        <tbody>
            <?php
            require_once ("backend/connect.php");
            
            $query = "SELECT * FROM users";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
                $username = $row["username"];
                $password = $row["password"];
                $name = $row["name"];
                $surname = $row["surname"];
                $role = $row["role"];
            ?>
                <tr align="center">
                <td><?php echo $username; ?></td>
                    <td><?php echo $password; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $surname; ?></td>
                    <td><?php echo $role; ?></td>
                    <td><button type="submit" type="button"><?php echo  "<a href='modifica_utente.php?mode=delete_user&username=" . $username . "' >Elimina</a>"; ?></button></td>
                    <td><button name="update"  type="submit" onclick="" type="button"><?php echo  "<a href='modifica_utente.php?mode=update_user&username=" . $username . "'>Modifica</a>"; ?></button></td>
                </tr>

            <?php }
            ?>
        </tbody>

      </table>
    </div>
  <?php
  }

  session_start();
  if (isset($_SESSION["admin"])){
    main($_SESSION["admin"]);
  } else {
      header("Location: index.php");
  }
  ?>

</body>

</html>