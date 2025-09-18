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
    $id = $_POST['idExcluir'];

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
        <title>Exclusão de livro</title>
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
            <h1 class="centralizar">Exclusão de livro</h1>                
            <br>
            <form action="ControllersEntidadesDAO/ControllerLivroDAO.php" method="post">

                <input type="hidden" name="operacao" value="exclusao">

                <table>

                    <?php

                        //Declaração do array usado na função
                        $livro = array();

                        /*Função que transforma o valor do atributo disponível 
                        retornado do banco de dados*/
                        function transformaDisponivel( $valorDisponivel ){

                            if( $valorDisponivel == 0){

                                echo "Disponível";

                            } else if( $valorDisponivel == 1 ){

                                echo "Retirado";
                            } 
                        }

                        echo "<tr>

                            <input type='hidden' name='id' value='$id'>
                            <td class='alinhamentoCampo'>ID:</td>
                            <td class='alinhamentoValor'>$id</td>
                        </tr>
                        <tr>
                            <td class='alinhamentoCampo'>Nome:</td>
                            <td class='alinhamentoValor'>$nome</td>
                        </tr>
                        <tr>
                            <td class='alinhamentoCampo'>Estilo:</td>
                            <td class='alinhamentoValor'>$estilo</td>
                        </tr>
                        <tr>
                            <input type='hidden' name='disponivel' value='$disponivel'>

                            <td class='alinhamentoCampo'>Situação:</td>
                            <td class='alinhamentoValor'>"
                            ,transformaDisponivel($disponivel),"</td>
                        </tr>"; 
                        
                    ?>

                </table>
                <br>

                <div>
                    <input class="botao bordaBotao espacoCorBotao" type="submit" id="excluirLivro" name="excluirLivro" value="Excluir livro"> 
                    <button class="botao bordaBotao">
                        <a href="livroListagem.php">Cancelar exclusão</a>
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