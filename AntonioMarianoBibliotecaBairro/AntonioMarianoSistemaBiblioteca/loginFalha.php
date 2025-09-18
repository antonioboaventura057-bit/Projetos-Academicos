<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="navegacao.js"></script>
        <title>Erro de login</title>
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
            <h1 class="centralizar">Erro de Login</h1>
            <br>
            <p class="falhaLogin">Login e/ou senha estão inválidos!</p>
            <br><br>
            <p class="falhaLogin">Faça login:</p>            
            <button class="botao bordaBotao margemBotao" onclick="login()">
                <a>Entrar</a> 
            </button>                     
        </main>
        <footer>
            <p>© Biblioteca do Bairro - Todos os direitos reservados</p>
            <p>Desenvolvido por Antônio Mariano</p>
        </footer> 
    </body>
</html>