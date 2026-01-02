<!DOCTYPE html>
<html lang="pt-pt">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Cadastro</title>
  <link rel="stylesheet" href="css/cadastro.css" />
  <link rel="icon" href="../favcon/favicon.ico">
</head>

<body>
  <div class="container" id="container">
    <div class="containerImagemBackground"></div>
    <div class="topo">
      <header id="headerID"><label for="nome_completo">Reservado a Dadores</label></header>
    </div>
    <br />

    <div class="colunaFormulario">
      <fieldset>
        <legend>Cadastro do Doador</legend>

        <form action="index.php?c=usuario&a=registarDador" method="POST">
          <div class="inputs">
            <label for="nome_completo">Nome completo:</label> 
            <input type="text" id="nome_completo" name="nome_completo" placeholder="Nome completo"  />
            <br /><br />

            <label for="data_nascimento">Data de nascimento:</label>
            <input type="date" id="data_nascimento" name="data_nascimento"  />
            <br /><br />

            <label for="sexo">Sexo:</label>
            <select id="sexo" name="sexo" >
              <option value="" selected disabled>Selecione o Sexo</option>
              <option>Masculino</option>
              <option>Feminino</option>
            </select>
            <br /><br />
            <label for="tipoDocumento">Tipo de Documento:</label>
            <select id="sexo" name="sexo" >
              <option value="" selected disabled>Selecione o tipo de Documento</option>
              <option>Bilhete</option>
              <option>Passaporte</option>
            </select>
            <br /><br />

            <label for="documento">Nº do Documento:</label>
            <input type="text" id="documento" name="documento" placeholder="Documento Nº"  />
            <br /><br />

            <fieldset>
              <legend class="informacoes">Contactos</legend>

              <label for="telefone">Telefone:</label>
              <input type="tel" id="telefone" name="telefone" placeholder="Telefone" />
              <br /><br />

              <label for="email">Email:</label>
              <input type="email" id="email" name="email" placeholder="example@gmail.com"  />
            </fieldset>
            <br />

            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" placeholder="Senha"  />
            <br /><br />

            <label for="confirma_senha">Confirme a senha:</label>
            <input type="password" id="confirma_senha" name="confirma_senha" placeholder="Confirme a senha"  />
            <br /><br />
            <button type="submit">Cadastrar</button><br />
            <p>
              Ja possuí uma conta?
              <a href="index.php?c=usuario&a=getLoginPublico">Iniciar sessão</a>
            </p>
          </div>
        </form>
      </fieldset>
    </div>
  </div>
</body>

</html>