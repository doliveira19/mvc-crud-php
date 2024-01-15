<?php
error_reporting(0);
include('../../controllers/login/LoginController.php');

// Verificar se o usuário está autenticado
session_start();
if (!isset($_SESSION['user_authenticated']) || !$_SESSION['user_authenticated']) {
    header('Location: views/login/login.php');
    exit();
}

// Se estiver autenticado, redirecionar para o controlador de clientes
header('Location: controllers/cliente/ClienteController.php');
