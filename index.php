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
            <a href="allenamento.html"><span>Allenamento</span></a>
            <a href="progressi.html"><span>Progressi</span></a>
    </div>
    </nav>
    <div class="content">
        <h2>Accedi per usare l'app</h3>
        <form action="finance.php" method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" required>

            <label for="password">Password</label>
            <input type="password" name="password" required>

            <input type="submit" name="button" value="Accedi">
        </form>
    </div>
</body>

</html>