<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="navegacao.js"></script>
        <title>Login</title>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a onclick="index()">Biblioteca do Bairro</a></li>
                    <li><a onclick="login()">Login</a></li>                    
                </ul>  
            </nav>
        </header>     
        <main>  
            <br>          
            <h1 class="centralizar">Login</h1>           
            <br>
            <form action="ControllersEntidadesDAO/ControllerUsuarioDAO.php" method="post">
                <label>Login:</label>
                <br>
                <input type="text" id="login" name="login" placeholder="Login" 
                minlength="3" maxlength="45" required>
                <br><br>
                <label>Senha:</label>
                <br>
                <input type="password" id="senha" name="senha" placeholder="Senha" 
                minlength="3" maxlength="45" required>
                <br><br><br>

                <div>
                    <input class="botao bordaBotao espacoCorBotao" type="submit" id="logar" name="logar" value="Entrar"> 
                    <button class="botao bordaBotao">
                        <a href="index.php">Cancelar login</a>
                    </button>                                                             
                </div>
            </form>           
        </main>
        <footer>
            <p>© Biblioteca do Bairro - Todos os direitos reservados</p>
            <p>Desenvolvido por Antônio Mariano</p>
        </footer> 
    </body>
</html>