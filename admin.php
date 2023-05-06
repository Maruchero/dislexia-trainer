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
  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
</head>

<body>
  <?php
  function main($username){
    ?>
    <div class="content">
      <h1 class="title">Profilo utente</h1>
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <tr>
            <th>Nome utente</th>
            <th>Password</th>
            <th>Nome</th>
            <th>Cognome</th>
            <!-- <th>Ruolo</th> -->

        </tr>
        <tbody>
            <?php
            require_once ("backend/connect.php");
            
            $query = "SELECT * FROM users";
            $result = mysqli_query($conn, $query);
            while ($row = mysqli_fetch_array($result)) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
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
                    <td><button type="submit" type="button"><?php echo  "<a href='modifica_utente.php?mode=delete_user&username=" . $username . "' >Elimina</a>"; ?></button>
                    <button name="update"  type="submit" onclick="" type="button"><?php echo  "<a href='modify_utente.php?mode=delete_user&username=" . $username . "'>Modifica</a>"; ?></button></td>
                    <td></td>
                </tr>

            <?php }
            ?>
        </tbody>

    </table>

























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
            $role = $row["role"];
        }
        $conn->close();

        echo ("<table>
                <tr><td>Nome utente:</td><td>" . $username . "</td></tr>
                <tr><td>Password:</td><td>" . str_repeat("•", strlen($password)) . "</td></tr>
                <tr><td>Nome:</td><td>" . $name . "</td></tr>
                <tr><td>Cognome:</td><td>" . $surname . "</td></tr>
              </table>");
      ?>
      <td>
        <button type="submit" name="update" type="button"> <a href='modifica_utente.php?mode=update_user'>Modifica</a></button>
        <?php if (isset($_SESSION["admin"])){ echo "<button type='submit' name='button' type='button'><a href='modifica_utente.php?mode=delete_user'>Elimina</a></button>";}?>
        
      </td>

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