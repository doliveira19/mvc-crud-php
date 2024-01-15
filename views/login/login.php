<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/css/styles.css">
    <title>Login</title>
</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form method="post" action="../../controllers/login/LoginController.php?action=login">
            <label for="username">Usuário:</label><br>
            <input type="text" id="username" name="username" required><br>
            <label for="password">Senha:</label><br>
            <input type="password" id="password" name="password" required><br>
            <button class="button-submit" type="submit">Entrar</button>
        </form>
    </div>
</body>

</html>