<!-- models/UserModel.php -->
<?php
class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function register($username, $password) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $role = 'user'; // Defina o papel como 'user' por padrão
    
        try {
            $stmt = $this->conn->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $passwordHash);
            $stmt->bindParam(':role', $role);
    
            $stmt->execute();
            return true; // Registro bem-sucedido
        } catch (PDOException $e) {
            echo "Erro ao registrar o usuário: " . $e->getMessage();
            return false;
        }
    }
    

    public function login($username, $password) {
        try {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username=:username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                return $user;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            echo "Erro ao realizar o login: " . $e->getMessage();
            return false;
        }
    }
}
?>
