<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/styles.css">
  <script src="https://kit.fontawesome.com/96362d3168.js" crossorigin="anonymous"></script>
  <title>Lista de Clientes</title>
</head>

<body>
  <div class="button-header-solo"><button type="button" class="logout-button"><a
        href="../../controllers/login/LoginController.php?action=logout"><i
          class="fa-solid fa-right-from-bracket"></i>Sair</a></button>
  </div>
  <div class="container">
    <h2>Lista de Clientes</h2>
    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>Endereço</th>
        <th>Ações</th>
      </tr>
      <?php foreach ($clientes as $cliente): ?>
        <tr>
          <td>
            <?= $cliente['id']; ?>
          </td>
          <td>
            <?= $cliente['nome']; ?>
          </td>
          <td>
            <?= $cliente['email']; ?>
          </td>
          <td>
            <?= $cliente['telefone']; ?>
          </td>
          <td>
            <?= $cliente['endereco_cep'] . ", " . $cliente['endereco'] . ", " . $cliente['endereco_numero'] . ", " . $cliente['endereco_complemento'] . ", " . $cliente['endereco_bairro'] . ", " . $cliente['endereco_cidade'] . ", " . $cliente['endereco_estado']; ?>
          </td>
          <td>
            <a href="?action=editar&id=<?= $cliente['id']; ?>"><i class="fa-solid fa-pen-to-square"
                style="font-size:20px"></i></a>
            <a href="?action=excluir&id=<?= $cliente['id']; ?>"
              onClick="return confirm('Deseja mesmo excluir esse cliente?');"><i class="fa-solid fa-trash"
                style="font-size:20px"></i></a>
          </td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <td colspan='6'><button type="button" class="button-submit"><a href="?action=adicionar"><i
                class="fa-solid fa-plus"></i> Adicionar</a></button></td>
      </tr>
    </table>
  </div>
</body>

</html>