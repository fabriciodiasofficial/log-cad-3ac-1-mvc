<!-- restricted_area.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Área Restrita</title>
</head>
<body>
    <h2>Área Restrita do Usuário</h2>
    <p>Bem-vindo, <?php echo $_SESSION['username']; ?>!</p>
    <a href="index.php?action=logout">Logout</a>
</body>
</html>
