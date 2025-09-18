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

    //Faz a listagem dos livros
    $querySelect = "SELECT * FROM livro";

    //Executa a query SQL de select
    $resultadoObtido = mysqli_query($conecta, $querySelect);

?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="navegacao.js"></script>
        <title>Listagem de livros</title>
        <style>
            .corTextoBotaoTabela{
                color: yellow;
            }
        </style>
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
            <section>
                <br>
                <h1 class="centralizar">Listagem de livros</h1>                
                <button class="botao bordaBotao margemBotao" onclick="livroCadastro()">
                    <a>Cadastrar livro</a> 
                </button>
                <br>
                <button class="botao bordaBotao margemBotao" onclick="loginSucesso()">
                    <a>Voltar</a> 
                </button>
                <br>
                <table class="estilosTabela">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Estilo</th> 
                        <th>Situação</th>                       
                        <th colspan="2">Ação</th>
                    </tr>

                    <?php                        
                        //Declaração do array usado na função
                        $livro = array();

                        /*Função que transforma o valor do atributo disponível 
                        retornado do banco de dados*/
                        function transformaDisponivel( $array ){

                            if( $array[3] == 0){

                                echo "Disponível";

                            } else if( $array[3] == 1 ){

                                echo "Retirado";
                            } 
                        }

                        //Escreve cada linha da tabela do banco
                        /*A função mysqli_fetch_array percorre linha por linha 
                        da váriavel resultadoObtido e armazena cada linha em um array*/
                        while($arrayLivro = mysqli_fetch_array ($resultadoObtido) ){
                            
                            echo "<tr class='corLinhaTabela'>
                                <td class='alinhamentoColunaTabela'>$arrayLivro[ID]</td>
                                <td class='alinhamentoColunaTabela'>$arrayLivro[nome]</td>
                                <td class='alinhamentoColunaTabela'>$arrayLivro[estilo]</td>
                                <td class='alinhamentoColunaTabela'>"
                                ,transformaDisponivel($arrayLivro),
                                "</td>
                                <form action='livroAlterar.php' method='post'>
                                    <input name='idAlterar' type='hidden' value='$arrayLivro[ID]'/>
                                    <td class='alinhamentoColunaTabela'>
                                        <div class='centralizarBotao'>
                                            <input class='botaoTabela bordaBotao corTextoBotaoTabela'
                                            type='submit' id='processaAlterarLivro' 
                                            name='processaAlterarLivro' value='Atualizar'>                                            
                                        </div>
                                    </td>
                                </form>
                                <form action='livroExcluir.php' method='post'>
                                    <input name='idExcluir' type='hidden' value='$arrayLivro[ID]'/>
                                    <td class='alinhamentoColunaTabela'>
                                        <div class='centralizarBotao'>
                                            <input class='botaoTabela bordaBotao corTextoBotaoTabela'
                                            type='submit' id='processaExcluirLivro' 
                                            name='processaExcluirLivro' value='Excluir'>
                                        </div>
                                    </td>
                                </form>
                            </tr>";      
                        }                    
                    ?>

                </table>
            </section>            
            <button class="botao bordaBotao margemBotao" onclick="loginSucesso()">
                <a>Voltar</a> 
            </button>            
        </main>
        <br><br><br><br><br>
        <footer>
            <p>© Biblioteca do Bairro - Todos os direitos reservados</p>
            <p>Desenvolvido por Antônio Mariano</p>
        </footer> 
    </body>
</html>