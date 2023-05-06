<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Allenamento</title>

  <link rel="stylesheet" href="css/global.css">
  <link rel="stylesheet" href="css/profilo.css">
  <script src="js/ajax.js"></script>
  <script src="js/allenamento.js" defer></script>
  
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
      <h1 class="title">Profilo utente</h1>
      <?php
      function delete_user($username){

      }

      function modify_user($username){
        
      }
      ?>
    </div>
  <?php
  }

  session_start();
  if (isset($_SESSION["username"]) && isset($_GET['mode'])){
    main();
    switch ($_POST["mode"]) {

        case 'delete_user':
            delete_user($_SESSION["username"]);
          break;
      
        case 'modify_user':
            modify_user($_SESSION["username"]);  
          break;
      }
    
  } else {
      header("Location: index.php");
  }
  ?>

</body>

</html>