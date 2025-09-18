<?php

require "ControllersEntidadesDAO/Leitor.php";

    //Faz a conexão com o banco de dados
    $conecta = mysqli_connect(
        'localhost',	//Endereço do banco 
        'root',			//Usuário banco
        '', 			//Senha do banco
        'biblioteca'	//Nome do banco de dados
    ); 

    //Obtém o ID do leitor: o ID vem da página de listagem de leitores
    $id = $_POST['idExcluir'];

    //Seleciona a base de dados
    mysqli_select_db($conecta, 'biblioteca');

    //Obtém os dados do leitor de acordo com o ID
    $querySelectById = "SELECT * FROM leitor WHERE ID = $id; ";

    //Executa a query SQL de selecionar leitor por ID
    $resultadoObtido = mysqli_query($conecta, $querySelectById);

    //Instância um objeto do tipo Leitor
    $leitor = new Leitor();

    /*A função mysqli_fetch_array percorre linha por linha da 
    váriavel resultadoObtido e armazena cada linha em um array*/
    if( $arrayLeitor = mysqli_fetch_array ($resultadoObtido) ){
        
        $leitor->setId($arrayLeitor[0]);
        $leitor->setNomeCompleto($arrayLeitor[1]);
        $leitor->setCpf($arrayLeitor[2]);
        $leitor->setTelefone($arrayLeitor[3]);
        $leitor->setFoto($arrayLeitor[4]);
        $leitor->setQuantidadeLivros($arrayLeitor[5]); 
        
        $id = $leitor->getId();
        $nomeCompleto = $leitor->getNomeCompleto();
        $cpf = $leitor->getCpf();
        $telefone = $leitor->getTelefone();
        $foto = $leitor->getFoto();
        $quantidadeLivros = $leitor->getQuantidadeLivros();
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
        <title>Exclusão de leitor</title>
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
            <h1 class="centralizar">Exclusão de leitor</h1>                
            <br>
            <form action="ControllersEntidadesDAO/ControllerLeitorDAO.php" method="post">

            <input type="hidden" name="operacao" value="exclusao">

                <table>

                    <?php

                        echo "<tr>
                            <input type='hidden' name='id' value='$id'>
                            <td class='alinhamentoCampo'>ID:</td>
                            <td class='alinhamentoValor'>$id</td>
                        </tr>
                        <tr>
                            <td class='alinhamentoCampo'>Nome completo:</td>
                            <td class='alinhamentoValor'>$nomeCompleto</td>
                        </tr>
                        <tr>
                            <td class='alinhamentoCampo'>CPF:</td>
                            <td class='alinhamentoValor'>$cpf</td>
                        </tr> 
                        <tr>
                            <td class='alinhamentoCampo'>Telefone:</td>
                            <td class='alinhamentoValor'>$telefone</td>
                        </tr>                    
                        <tr>
                            <input type='hidden' name='quantidadeLivros' value='$quantidadeLivros'>
                            <td class='alinhamentoCampo'>Quantidade de livros:</td>
                            <td class='alinhamentoValor'>$quantidadeLivros</td>
                        </tr>"; 

                    ?>

                </table>
                <br>

                <div>
                    <input class="botao bordaBotao espacoCorBotao" type="submit" id="excluirLeitor" name="excluirLeitor" value="Excluir leitor"> 
                    <button class="botao bordaBotao">
                        <a href="leitorListagem.php">Cancelar exclusão</a>
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