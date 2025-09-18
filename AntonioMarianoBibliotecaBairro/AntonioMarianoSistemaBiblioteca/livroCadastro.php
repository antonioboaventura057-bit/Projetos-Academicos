<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="navegacao.js"></script>
        <title>Cadastro de livro</title>
    </head>
    <body>
        <header>
            <nav>
                <ul>
                    <li><a onclick="index()">Biblioteca do Bairro</a></li>
                    <li><a onclick="login()">Login</a></li>
                    <li><a onclick="livroListagem()">Livros</a></li>
                    <li><a onclick="leitorListagem()">Leitores</a></li>
                    <li><a onclick="emprestimoDevolucaoListagem()">Empréstimos e Devoluções</a></li>
                </ul>  
            </nav>
        </header>
        <main>
            <br>
            <h1 class="centralizar">Cadastro de livro</h1>                
            <br>
            <form action="ControllersEntidadesDAO/ControllerLivroDAO.php" method="post">

                <input name="operacao" type="hidden" value="cadastro"/>

                <label>Nome:</label>
                <br>
                <input type="text" id="nome" name="nome" placeholder="Nome" 
                minlength="5" maxlength="100" required>
                <br><br>
                <label>Estilo:</label>
                <br>
                <select name="estilo" id="estilo" required>
                    <option value="">Selecione o estilo</option>
                    <option value="Mistério">Mistério</option>
                    <option value="Aventura">Aventura</option>
                    <option value="Romance">Romance</option>
                    <option value="Biografia">Biografia</option>
                    <option value="Auto-ajuda">Auto-ajuda</option>                                        
                </select>
                <br><br><br>

                <div>
                    <input class="botao bordaBotao espacoCorBotao" type="submit" id="cadastroLivro" name="cadastroLivro" value="Cadastrar livro"> 
                    <button class="botao bordaBotao">
                        <a href="livroListagem.php">Cancelar cadastro</a>
                    </button>                                                             
                </div>
            </form>                      
        </main>
        <br>
        <footer>
            <p>© Biblioteca do Bairro - Todos os direitos reservados</p>
            <p>Desenvolvido por Antônio Mariano</p>
        </footer> 
    </body>
</html>