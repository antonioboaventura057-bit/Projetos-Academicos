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

    //Faz a listagem dos leitores
    $querySelect = "SELECT * FROM leitor";

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
        <title>Listagem de leitores</title>
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
                <h1 class="centralizar">Listagem de leitores</h1>                
                <button class="botao bordaBotao margemBotao" onclick="leitorCadastro()">
                    <a>Cadastrar leitor</a> 
                </button>
                <br>
                <button class="botao bordaBotao margemBotao" onclick="loginSucesso()">
                    <a>Voltar</a> 
                </button>
                <br>
                <table class="estilosTabela">
                    <tr>
                        <th>Id</th>
                        <th>Nome completo</th>
                        <th>CPF</th>  
                        <th>Telefone</th>                        
                        <th>Quantidade de livros</th>                                           
                        <th colspan="2">Ação</th>
                    </tr>

                    <?php

                        //Escreve cada linha da tabela do banco
                        /*A função mysqli_fetch_array percorre linha por linha 
                        da váriavel resultadoObtido e armazena cada linha em um array*/
                        while($arrayLeitor = mysqli_fetch_array ($resultadoObtido) ){

                            echo "<tr class='corLinhaTabela'>
                                <td class='alinhamentoColunaTabela'>$arrayLeitor[ID]</td>
                                <td class='alinhamentoColunaTabela'>$arrayLeitor[nome_completo]</td>
                                <td class='alinhamentoColunaTabela'>$arrayLeitor[CPF]</td>
                                <td class='alinhamentoColunaTabela'>$arrayLeitor[telefone]</td>
                                <td class='alinhamentoColunaTabela'>$arrayLeitor[quantidade_livros]</td>                                                
                                <form action='leitorAlterar.php' method='post'>
                                    <input name='idAlterar' type='hidden' value='$arrayLeitor[ID]'/>
                                    <td class='alinhamentoColunaTabela'>
                                        <div class='centralizarBotao'>
                                            <input class='botaoTabela bordaBotao corTextoBotaoTabela'
                                            type='submit' id='processaAlterarLeitor' 
                                            name='processaAlterarLeitor' value='Atualizar'>
                                        </div>
                                    </td>
                                </form>
                                <form action='leitorExcluir.php' method='post'>
                                    <input type='hidden' name='idExcluir' value='$arrayLeitor[ID]'>
                                    <td class='alinhamentoColunaTabela'>
                                        <div class='centralizarBotao'>
                                            <input class='botaoTabela bordaBotao corTextoBotaoTabela'
                                            type='submit' id='processaExcluirLeitor' 
                                            name='processaExcluirLeitor' value='Excluir'>
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