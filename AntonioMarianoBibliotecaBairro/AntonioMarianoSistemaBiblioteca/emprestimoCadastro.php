<?php

    //Faz a conexão com o banco de dados
    $conecta = mysqli_connect(
        'localhost',	//Endereço do banco 
        'root',			//Usuário banco
        '', 			//Senha do banco
        'biblioteca'	//Nome do banco de dados
    ); 

    //Seleciona a base de dados
    mysqli_select_db($conecta, 'biblioteca');


    //Livros
    //Faz a listagem dos livros disponíveis para emprestimo
    $querySelectLivros = "SELECT * FROM livro WHERE disponivel = 0; ";

    //Executa a query SQL de select dos livros disponíveis para emprestimo
    $resultadoLivros = mysqli_query($conecta, $querySelectLivros);


    //Leitores
    //Faz a listagem dos leitores que podem fazer emprestimos de livros
    $querySelectLeitores = "SELECT * FROM leitor WHERE quantidade_livros < 3; ";

    //Executa a query SQL de select dos leitores que podem fazer emprestimos de livros
    $resultadoLeitores = mysqli_query($conecta, $querySelectLeitores);

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="navegacao.js"></script>
        <title>Retirada de livro</title>
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
            <h1 class="centralizar">Retirada de livro</h1>                
            <br>
            <form action="ControllersEntidadesDAO/ControllerEmprestimoDevolucaoDAO.php" method="post"> 
                
                <input type="hidden" name="operacao" value="emprestimo">

                <label>Leitor:</label>
                <br>
                <select name="leitor" id="leitor" required>
                    <option value="">Selecione o leitor</option>

                    <?php
                        //Escreve cada linha da tabela do banco
                        /*A função mysqli_fetch_array percorre linha por linha 
                        da váriavel resultadoObtido e armazena cada linha em um array*/
                        while($arrayLeitor = mysqli_fetch_array ($resultadoLeitores) ){

                            echo "<option value='$arrayLeitor[ID]'>$arrayLeitor[nome_completo]</option>";                   
                        }
                    ?>

                </select>
                <br><br>
                <label>Livro:</label>
                <br>
                <select name="livro" id="livro" required>
                    <option value="">Selecione o livro</option>                 
                        
                    <?php
                        //Escreve cada linha da tabela do banco
                        /*A função mysqli_fetch_array percorre linha por linha 
                        da váriavel resultadoObtido e armazena cada linha em um array*/
                        while($arrayLivro = mysqli_fetch_array ($resultadoLivros) ){

                            echo "<option value='$arrayLivro[ID]'>$arrayLivro[nome]</option>";                   
                        }
                    ?>                    

                </select>
                <br><br><br>

                <div>
                    <input class="botao bordaBotao espacoCorBotao" type="submit" 
                    id="cadastroEmprestimo" name="cadastroEmprestimo" value="Retirar livro"> 
                    <button class="botao bordaBotao">
                        <a href="emprestimoDevolucaoListagem.php">Cancelar retirada</a>
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