<?php

require "ControllersEntidadesDAO/Livro.php";

    //Faz a conexão com o banco de dados
    $conecta = mysqli_connect(
        'localhost',	//Endereço do banco 
        'root',			//Usuário banco
        '', 			//Senha do banco
        'biblioteca'	//Nome do banco de dados
    ); 

    //Obtém o ID do livro: o ID vem da página de listagem de livros
    $id = $_POST['idAlterar'];

    //Seleciona a base de dados
    mysqli_select_db($conecta, 'biblioteca');

    //Obtém os dados do livro de acordo com o ID
    $querySelectById = "SELECT * FROM livro WHERE ID = $id; ";

    //Executa a query SQL de selecionar livro por ID
    $resultadoObtido = mysqli_query($conecta, $querySelectById);

    //Instância um objeto do tipo Livro
    $livro = new Livro();

    /*A função mysqli_fetch_array percorre linha por linha da 
    váriavel resultadoObtido e armazena cada linha em um array*/
    if( $arrayLivro = mysqli_fetch_array ($resultadoObtido) ){
        
        $livro->setId($arrayLivro[0]);
        $livro->setNome($arrayLivro[1]);
        $livro->setEstilo($arrayLivro[2]);
        $livro->setDisponivel($arrayLivro[3]); 
        
        $id = $livro->getId();
        $nome = $livro->getNome();
        $estilo = $livro->getEstilo();
        $disponivel = $livro->getDisponivel();
    }

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="navegacao.js"></script>
        <title>Atualização de livro</title>
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
            <h1 class="centralizar">Atualização de livro</h1>                
            <br>

            <?php

                echo "<form action='ControllersEntidadesDAO/ControllerLivroDAO.php' method='post'>
                    
                    <input type='hidden' name='operacao' value='alteracao'>

                    <input type='hidden' name='id' value='$id'>


                    <label>Nome:</label>
                    <br>
                    <input type='text' id='nome' name='nome' placeholder='Nome' 
                    minlength='5' maxlength='100' value='$nome' required>
                    <br><br>
                    <label>Estilo:</label>
                    <br>
                    <select name='estilo' id='estilo' required>
                        <option value='$estilo'>$estilo</option>                        
                        <option value='Mistério'>Mistério</option>
                        <option value='Aventura'>Aventura</option>
                        <option value='Romance'>Romance</option>
                        <option value='Biografia'>Biografia</option>
                        <option value='Auto-ajuda'>Auto-ajuda</option>                                        
                    </select>
                    <br><br><br>

                    <div>
                        <input class='botao bordaBotao espacoCorBotao' type='submit'
                        id='alterarLivro' name='alterarLivro' value='Atualizar livro'> 
                        <button class='botao bordaBotao'>
                            <a href='livroListagem.php'>Cancelar atualização</a>
                        </button>                                                             
                    </div>
                </form>";
            
            ?>  

        </main>
        <br>
        <footer>
            <p>© Biblioteca do Bairro - Todos os direitos reservados</p>
            <p>Desenvolvido por Antônio Mariano</p>
        </footer> 
    </body>
</html>