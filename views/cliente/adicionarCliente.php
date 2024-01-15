<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/styles.css">
  <title>Adicionar Cliente</title>
  <script src="https://kit.fontawesome.com/96362d3168.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <!-- Adicionando Javascript -->
  <script>

    $(document).ready(function () {

      function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#endereco").val("");
        $("#bairro").val("");
        $("#cidade").val("");
        $("#estado").val("");
      }

      //Quando o campo cep perde o foco.
      $("#cep").blur(function () {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

          //Expressão regular para validar o CEP.
          var validacep = /^[0-9]{8}$/;

          //Valida o formato do CEP.
          if (validacep.test(cep)) {

            //Preenche os campos com "..." enquanto consulta webservice.
            $("#endereco").val("...");
            $("#bairro").val("...");
            $("#cidade").val("...");
            $("#estado").val("...");

            //Consulta o webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

              if (!("erro" in dados)) {
                //Atualiza os campos com os valores da consulta.
                $("#endereco").val(dados.logradouro);
                $("#bairro").val(dados.bairro);
                $("#cidade").val(dados.localidade);
                $("#estado").val(dados.uf);
              } //end if.
              else {
                //CEP pesquisado não foi encontrado.
                limpa_formulário_cep();
                alert("CEP não encontrado.");
              }
            });
          } //end if.
          else {
            //cep é inválido.
            limpa_formulário_cep();
            alert("Formato de CEP inválido.");
          }
        } //end if.
        else {
          //cep sem valor, limpa formulário.
          limpa_formulário_cep();
        }
      });
    });

  </script>
</head>

<body>
  <div class="button-header">
    <button type="button" class="button-back"><a href="?action=index"><i
          class="fa-solid fa-arrow-left"></i>Voltar</a></button>
    <button type="button" class="logout-button"><a href="../../controllers/login/LoginController.php?action=logout"><i
          class="fa-solid fa-right-from-bracket"></i>Sair</a></button>
  </div>
  <div class="container">
    <h2>Adicionar Cliente</h2>
    <form method="post" action="?action=adicionar">
      <label for="nome">Nome:</label><br>
      <input type="text" id="nome" name="nome" required><br>
      <label for="email">Email:</label><br>
      <input type="email" id="email" name="email" required><br>
      <label for="telefone">Telefone:</label><br>
      <input type="text" id="telefone" name="telefone" required><br>
      <label for="cep">CEP:</label><br>
      <input type="text" id="cep" name="cep" required><br>
      <label for="endereco">Endereco:</label><br>
      <input type="text" id="endereco" name="endereco" required><br>
      <label for="numero">Numero:</label><br>
      <input type="text" id="numero" name="numero" required><br>
      <label for="complemento">Complemento:</label><br>
      <input type="text" id="complemento" name="complemento"><br>
      <label for="bairro">Bairro:</label><br>
      <input type="text" id="bairro" name="bairro" required><br>
      <label for="cidade">Cidade:</label><br>
      <input type="text" id="cidade" name="cidade" required><br>
      <label for="estado">Estado:</label><br>
      <input type="text" id="estado" name="estado" required><br>

      <button type="submit" class="button-submit">Salvar</button>
    </form>
  </div>
</body>

</html>