<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="navegacao.js"></script>
        <title>Biblioteca do Bairro</title>
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
            <section>
                <br>
                <h1 class="centralizar">Biblioteca do Bairro</h1>
                <h2 class="centralizar">Plataforma de Conexão entre Leitores e o Fantástico Mundo da Leitura</h2>
                <h2 class="centralizar">Dentro dos livros existe o transformador mundo do conhecimento</h2>
                <div class="imagem">
                    <img src="img/livro.jpg" alt="Leia um Livro" height="300px" width="500px">
                </div>                
            </section>
            <br>
            <section>
                <table class="centralizarTabela">
                    <tr>
                        <td class="colunasIndex">Faça login:</td>                        
                    </tr>
                    <tr>                        
                        <td class="colunasIndex">
                            <div class="centralizarBotao">
                            <button class="botao bordaBotao" onclick="login()">
                                <a>Login</a>
                            </button>
                            </div>
                        </td>
                    </tr>
                </table>        
                <br><br><br><br><br>
            </section>
        </main>
        <footer>
            <p>© Biblioteca do Bairro - Todos os direitos reservados</p>
            <p>Desenvolvido por Antônio Mariano</p>
        </footer> 
    </body>
</html>