<?php
error_reporting(0);
class LoginController
{
    public function login($username, $password)
    {
        if ($username === 'admin@admin.com' && $password === 'admin') {
            session_start();
            $_SESSION['user_authenticated'] = true;
            header('Location: ../cliente/ClienteController.php');
            exit();
        } else {
            echo "<h1>Credenciais de acesso inválidas</h1>";
        }
    }

    public function logout()
    {
        session_destroy();
        header('Location: ../../index.php');
        exit();
    }
}

$loginController = new LoginController();
session_start();

$action = '';
if (isset($_GET['action']))
    $action = $_GET['action'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $action == 'login') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $loginController->login($username, $password);
}

if ($action == 'logout') {
    $loginController->logout();
}
