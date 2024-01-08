<!-- index.php -->
<?php
require_once 'config/Database.php';
require_once 'models/UserModel.php';
require_once 'controllers/AuthController.php';

$action = isset($_GET['q']) ? $_GET['q'] : 'register';

$db = new Database();
$conn = $db->getConnection();

$userModel = new UserModel($conn);
$authController = new AuthController($userModel);

switch ($action) {
    case 'register':
        $authController->register();
        break;
    case 'login':
        $authController->login();
        break;
    case 'restricted_area':
        $authController->restrictedArea();
        break;
    case 'logout':
        $authController->logout();
        break;
    default:
        echo "Ação inválida.";
}
?>
