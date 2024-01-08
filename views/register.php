<!-- views/register.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>
    <h2>Registro</h2>
    <h3><a href="index.php?q=login">Login</a></h3><br>

    <form action="index.php?q=register" method="post">
        <label for="username">Usuário:</label>
        <input type="text" name="username" required>
        <br>
        <label for="password">Senha:</label>
        <input type="password" name="password" required>
        <br>
        <input type="submit" value="Registrar">
    </form>
</body>
</html>
