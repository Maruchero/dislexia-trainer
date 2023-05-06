<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/index.css">
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

        require_once("backend/connect.php");

        $sql = "SELECT *
                FROM users
                WHERE username = '$username' AND password = '$password' AND role='User'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 1) {
            $_SESSION["user"] =  $username;
            header("Location: allenamento.php");
            exit;
        } else {
            $sql = "SELECT *
                    FROM users
                    WHERE username = '$username' AND password = '$password' AND role='Admin'";

            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) == 1) {
                $_SESSION["admin"] =  $username;
                header("Location: admin.php");
            } else {
                login($username, $password);
                echo "Username o password errate.";
            }
        }
        $conn->close();
    } else {
        login();
    }
    ?>
    
</body>

</html>