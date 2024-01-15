<?php
error_reporting(0);
include('../../config/database.php');
include('../../models/cliente/ClienteModel.php');

class ClienteController
{
    private $model;

    public function __construct($conn)
    {
        $this->model = new ClienteModel($conn);
    }

    public function index()
    {
        if (!$_SESSION['user_authenticated']) {
            echo "<h1>Sem acesso</h1>";
            exit();
        }
        $clientes = $this->model->getAllClientes();
        include('../../views/cliente/index.php');
    }

    public function adicionarCliente()
    {
        if (!$_SESSION['user_authenticated']) {
            echo "<h1>Sem acesso</h1>";
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $cliente = array(
                'nome' => $_POST['nome'],
                'email' => $_POST['email'],
                'telefone' => $_POST['telefone'],
                'endereco_cep' => $_POST['cep'],
                'endereco' => $_POST['endereco'],
                'endereco_numero' => $_POST['numero'],
                'endereco_complemento' => $_POST['complemento'],
                'endereco_bairro' => $_POST['bairro'],
                'endereco_cidade' => $_POST['cidade'],
                'endereco_estado' => $_POST['estado'],
            );

            if ($this->model->adicionarCliente($cliente)) {
                $this->index();
                exit();
            } else {
                echo "<h1>Erro ao adicionar cliente</h1>";
            }
        } else {
            include('../../views/cliente/adicionarCliente.php');
        }
    }

    public function editarCliente($id)
    {
        if (!$_SESSION['user_authenticated']) {
            echo "<h1>Sem acesso</h1>";
            exit();
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $cliente = [];
            $id = $_POST['id'];
            if ($_POST['nome'] && !empty(trim($_POST['nome']))) {
                $cliente["nome"] = $_POST['nome'];
            }
            if ($_POST['email'] && !empty(trim($_POST['email']))) {
                $cliente["email"] = $_POST['email'];
            }
            if ($_POST['telefone'] && !empty(trim($_POST['telefone']))) {
                $cliente["telefone"] = $_POST['telefone'];
            }
            if ($_POST['cep'] && !empty(trim($_POST['cep']))) {
                $cliente["endereco_cep"] = $_POST['cep'];
            }
            if ($_POST['endereco'] && !empty(trim($_POST['endereco']))) {
                $cliente["endereco"] = $_POST['endereco'];
            }
            if ($_POST['numero'] && !empty(trim($_POST['numero']))) {
                $cliente["endereco_numero"] = $_POST['numero'];
            }
            if ($_POST['complemento'] && !empty(trim($_POST['complemento']))) {
                $cliente["endereco_complemento"] = $_POST['complemento'];
            }
            if ($_POST['bairro'] && !empty(trim($_POST['bairro']))) {
                $cliente["endereco_bairro"] = $_POST['bairro'];
            }
            if ($_POST['cidade'] && !empty(trim($_POST['cidade']))) {
                $cliente["endereco_cidade"] = $_POST['cidade'];
            }
            if ($_POST['estado'] && !empty(trim($_POST['estado']))) {
                $cliente["endereco_estado"] = $_POST['estado'];
            }

            if (empty($cliente)) {
                echo "<h1>Nada a alterar</h1>";
                exit();
            }

            if ($this->model->editarCliente($id, $cliente)) {
                $this->index();
                exit();
            } else {
                echo "<h1>Erro ao editar cliente</h1>";
            }
        } else {
            $cliente = $this->model->getClienteById($id);
            include('../../views/cliente/editarCliente.php');
        }
    }

    public function excluirCliente($id)
    {
        if (!$_SESSION['user_authenticated']) {
            echo "<h1>Sem acesso</h1>";
            exit();
        }
        $this->model->excluirCliente($id);
        $this->index();
        exit();
    }
}

$controller = new ClienteController($conn);
session_start();

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    switch ($action) {
        case 'adicionar':
            $controller->adicionarCliente();
            break;
        case 'editar':
            $controller->editarCliente($id);
            break;
        case 'excluir':
            $controller->excluirCliente($id);
            break;
        default:
            $controller->index();
            break;
    }
} else {
    $controller->index();
}
