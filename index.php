<!DOCTYPE html>
<html>
<head>
  <title>Brasil Cash</title>
  <!-- icone -->
  <link rel="icon" href="imagem/logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="imagem/logo.png" type="image/x-icon" />
  <!-- folha css -->
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container" >
    <a class="links" id="paralogin"></a>
    <a class="links" id="paracadastro"></a>

    
    <div class="content">      
      <!--FORMULÁRIO DE LOGIN-->
      <div id="login">
        <form method="post" action="controller/loginController.php"> 
          <h1>Login</h1> 
          <p> 
            <label for="cpf">Seu CPF</label>
            <input id="cpf" name="cpf" required="required" type="text" placeholder="00061540164"/>
          </p>
          
          <p> 
            <label for="senha">Sua senha</label>
            <input id="senha" name="senha" required="required" type="password" placeholder="1234" /> 
          </p>
          
          <p> 
            <input type="checkbox" name="manterlogado" id="manterlogado" value="" /> 
            <label for="manterlogado">Manter-me logado</label>
          </p>
          
          <p> 
            <input type="submit" value="Logar" /> 
          </p>
          
          <p class="link">
            Ainda não tem conta?
            <a href="#paracadastro">Cadastre-se</a>
          </p>
        </form>
      </div>

      <!--FORMULÁRIO DE CADASTRO-->
      <div id="cadastro">
        <form method="post" action="controller/loginController.php"> 
          <h1>Login</h1> 
          <p> 
            <label for="cpf">Seu CPF</label>
            <input id="cpf" name="cpf" required="required" type="text" placeholder="00061540164"/>
          </p>
          
          <p> 
            <label for="senha">Sua senha</label>
            <input id="senha" name="senha" required="required" type="password" placeholder="1234" /> 
          </p>
          
          <p> 
            <input type="checkbox" name="manterlogado" id="manterlogado" value="" /> 
            <label for="manterlogado">Manter-me logado</label>
          </p>
          
          <p> 
            <input type="submit" value="Logar" /> 
          </p>
          
          <p class="link">  
            Já tem conta?
            <a href="#paralogin"> Ir para Login </a>
          </p>
        </form>
      </div>
    </div>
  </div>
</body>
</html>