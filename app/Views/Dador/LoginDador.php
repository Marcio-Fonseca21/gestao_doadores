<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link rel="stylesheet" href="css/Login.css" />
  <link rel="icon" href="../favcon/favicon.ico">
</head>

<body>
  <div class="topo">
    <header id="headerID">
      <label for="dador_bi">Reservado a Dadores</label>
    </header>
  </div>
  <div class="container">
    <div class="imagemFundo"></div>
    <div class="inputs-group">
      <form action="/gestao_doadores/public/loginPublico/login" method="POST">
        <fieldset>
          <legend>Login</legend>
          <?php
          if ($msg = Flash::get('login_erro')) {
            echo "<p style='color:red; text-align:center'>$msg</p>";
          }
          ?>


          <label for="dador_documento">Nº do Documento:</label>
          <input type="text" name="numeroDocumento" id="numeroDocumento" placeholder="Digite o número do Documento"
            required />

          <label for="dador_senha">Senha:</label>
          <input type="password" name="senha" id="senha" placeholder="Digite a sua senha" required />
          <button type="submit">Logar</button>
          <p>
            Não possuí uma conta? <a id="cadastrarA" href="/gestao_doadores/public/cadastroPublico">Cadastrar</a>
          </p>
        </fieldset>
      </form>
    </div>
  </div>
</body>

</html>