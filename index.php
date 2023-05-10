<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&family=Roboto&display=swap" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="left">
            <a href="allenamento.php"><span>Allenamento</span></a>
            <a href="progressi.php"><span>Progressi</span></a>
        </div>
    </nav>
    <?php
    function login($username = null, $password = null){
        ?>
        <div class="content">
            <h2>Accedi per usare l'app</h3>
            <form method="POST">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?php echo $username ?>" required>

                <label for="password">Password</label>
                <input type="password" name="password" value="<?php echo $password ?>" required>

                <input type="submit" name="button" value="Accedi">
            </form>
        </div>
        <?php
    }

    session_start();
    if (isset($_SESSION["user"])){
        header("Location: allenamento.php");
    } else if (isset($_SESSION["admin"])){
        header("Location: admin.php");
    }

    if (isset($_POST["button"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        require_once("backend/model/ModelUsers.php");

        $user = ModelUsers::get_user($username);
        print_r($user);

        if ($user && password_verify($password, $user["password"])) {
            if ($user["role"] == "Admin") {
                $_SESSION["admin"] =  $username;
                header("Location: allenamento.php");
            } else {
                $_SESSION["user"] =  $username;
                header("Location: admin.php");
            }
            exit;
        } else {
            login($username, $password);
            echo "Username o password errate.";
        }
    } else {
        login();
    }
    ?>
    
</body>

</html>