<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php
    session_start();
    if (isset($_SESSION['registration_success'])) {
        echo "<p>{$_SESSION['registration_success']}</p>";
        unset($_SESSION['registration_success']);
    }
    ?>

    <form action="index.php?q=login" method="post">
        <label for="username">Usuário:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Login">
    </form>
</body>
</html>
