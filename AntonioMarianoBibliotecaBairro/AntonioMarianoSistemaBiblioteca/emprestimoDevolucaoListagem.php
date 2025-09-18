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

    //Faz a listagem dos empréstimos e devoluções de livros
    $querySelect = "SELECT edl.ID idEDL, edl.acao acaoEDL, edl.quantidade_dias quantidadeDiasEDL,
    edl.valor_multa valorMultaEDL, edl.data_emprestimo dataEmprestimoEDL,
    edl.prazo_devolucao prazoDevolucaoEDL, edl.data_devolucao dataDevolucaoEDL,
    le.ID idLeitor, le.nome_completo nomeCompletoLeitor,
    li.ID idLivro, li.nome nomeLivro    
    FROM livro li, leitor le, emprestimo_devolucao_livro edl
    WHERE edl.FK_LEITOR_ID = le.ID AND edl.FK_LIVRO_ID = li.ID; ";

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
        <title>Listagem de empréstimos e devoluções</title>
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
                <h1 class="centralizar">Listagem de empréstimos e devoluções</h1>            
                <button class="botao bordaBotao margemBotao" onclick="emprestimoCadastro()">
                    <a>Retirar livro</a> 
                </button>
                <br>
                <button class="botao bordaBotao margemBotao" onclick="loginSucesso()">
                    <a>Voltar</a> 
                </button>
                <br>
                <table class="estilosTabela">
                    <tr>
                        <th>Id</th>
                        <th>Nome do leitor</th>
                        <th>Nome do livro</th> 
                        <th>Situação</th>
                        <th>Data do empréstimo</th>
                        <th>Prazo da devolução</th>
                        <th>Quantidade de dias</th>
                        <th>Data da devolução</th>
                        <th>Valor da multa (R$)</th>  
                        <th>Ação</th>                     
                    </tr>

                    <?php

                        //Escreve cada linha da tabela do banco
                        /*A função mysqli_fetch_array percorre linha por linha 
                        da váriavel resultadoObtido e armazena cada linha em um array*/
                        while($arrayEmprestimoDevolucao = mysqli_fetch_array ($resultadoObtido) ){

                            echo "<tr class='corLinhaTabela'>
                                <td class='alinhamentoColunaTabela'>$arrayEmprestimoDevolucao[0]</td>                                    
                                <td class='alinhamentoColunaTabela'>$arrayEmprestimoDevolucao[8]</td>                                    
                                <td class='alinhamentoColunaTabela'>$arrayEmprestimoDevolucao[10]</td>                                     
                                <td class='alinhamentoColunaTabela'>$arrayEmprestimoDevolucao[1]</td>                                    
                                <td class='alinhamentoColunaTabela'>$arrayEmprestimoDevolucao[4]</td>                                    
                                <td class='alinhamentoColunaTabela'>$arrayEmprestimoDevolucao[5]</td>                                    
                                <td class='alinhamentoColunaTabela'>$arrayEmprestimoDevolucao[2]</td>                                    
                                <td class='alinhamentoColunaTabela'>$arrayEmprestimoDevolucao[6]</td>                                    
                                <td class='alinhamentoColunaTabela'>$arrayEmprestimoDevolucao[3]</td>
                                <form action='ControllersEntidadesDAO/ControllerEmprestimoDevolucaoDAO.php' 
                                method='post'>
                                    <input type='hidden' name='operacao' value='devolucao'>
                                    <input type='hidden' name='idEmprestimoDevolucao'
                                    value='$arrayEmprestimoDevolucao[0]'>
                                    <td class='alinhamentoColunaTabela'>
                                        <div class='centralizarBotao'>
                                            <input class='botaoTabela bordaBotao corTextoBotaoTabela'
                                            type='submit' id='processaDevolucao' 
                                            name='processaDevolucao' value='Devolver livro'>
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