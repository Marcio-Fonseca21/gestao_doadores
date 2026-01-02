<!DOCTYPE html>
<html lang="pt-pt">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link rel="stylesheet" href="../../public/css/login.css" />
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
        <form action="dashbord.html" method="POST">
          <fieldset>
            <legend>Login</legend>
            <label for="dador_bi">Nº do BI:</label>
            <input
              type="text"
              name="dador_bi"
              id="dador_bi"
              placeholder="Digite o número do BI"
              required
            />

            <label for="dador_senha">Senha:</label>
            <input
              type="password"
              name="dador_senha"
              id="dador_senha"
              placeholder="Digite a sua senha"
              required
            />
            <button type="submit">Logar</button>
            <p>
              Não possuí uma conta? <a id ="cadastrarA" href="CadastroDador.php">Cadastrar</a>
            </p>
          </fieldset>
        </form>
      </div>
    </div>
  </body>
</html>
