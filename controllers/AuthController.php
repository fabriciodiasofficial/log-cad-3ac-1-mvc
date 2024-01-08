<!-- AuthController.php -->
<?php
class AuthController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $result = $this->userModel->register($_POST['username'], $_POST['password'], $_POST['role']);
            
            if ($result) {
                // Registro bem-sucedido
                session_start();
                $_SESSION['registration_success'] = "Usuário registrado com sucesso! Agora você pode fazer o login.";
                header("Location: index.php?q=login");
                exit();
            } else {
                echo "Erro ao registrar o usuário.";
            }
        }
        require_once 'views/register.php';
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->userModel->login($username, $password);

            if ($user) {
                session_start();
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $user['role']; // Adiciona o papel do usuário à sessão
                $this->redirectToRoleSpecificPage($user['role']);
            } else {
                echo "Senha ou usuário incorreto.";
            }
        }
        require_once 'views/login.php';
    }

    public function restrictedArea() {
        session_start();
        if (!isset($_SESSION['username'])) {
            header("Location: index.php?q=login");
            exit();
        }

        // Verifica o papel do usuário
        $role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
        if ($role == 'admin') {
            // Página específica para administradores
            require_once 'views/restricted_area_admin.php';
        } elseif ($role == 'manager') {
            // Página específica para gerentes
            require_once 'views/restricted_area_manager.php';
        } else {
            // Página padrão para usuários comuns
            require_once 'views/restricted_area.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?q=login");
        exit();
    }

    private function redirectToRoleSpecificPage($role) {
        if ($role == 'admin') {
            header("Location: index.php?q=restricted_area");
        } elseif ($role == 'manager') {
            header("Location: index.php?q=restricted_area");
        } else {
            header("Location: index.php?q=restricted_area");
        }
        exit();
    }
}
?>
