<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="navegacao.js"></script>
        <title>Recursos do sistema</title>
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
            <h1 class="centralizar">Recursos do sistema</h1>
            <br>
            <h2 class="centralizar">Seja bem-vindo(a) a página principal do sistema!</h2>
            <h2 class="centralizar">Nela você tem acesso a todos os recursos do sistema.</h2>
            <br><br>
            <section>
                <table class="centralizarTabela">
                    <tr>
                        <td class="colunasIndex">Cadastrar livros:</td>
                        <td class="colunasIndex">Cadastrar leitores:</td>
                        <td class="colunasIndex">Realize empréstimos e devoluções de livros:</td>
                    </tr>
                    <tr>
                        <td class="colunasIndex">
                        <div class="centralizarBotao">
                            <button class="botao bordaBotao" onclick="livroListagem()">
                                <a>Cadastre livros</a>
                            </button>
                        </div>
                        </td>
                        <td class="colunasIndex">
                            <div class="centralizarBotao">
                            <button class="botao bordaBotao" onclick="leitorListagem()">
                                <a>Cadastre leitores</a>
                            </button>
                            </div>
                        </td>
                        <td class="colunasIndex">
                            <div class="centralizarBotao">
                            <button class="botao bordaBotao" onclick="emprestimoDevolucaoListagem()">
                                <a>Empréstimos e devoluções</a>
                            </button>
                            </div>
                        </td>
                    </tr>
                </table>               
            </section>
            <br><br>
            <h3 class="margemTextoVoltar">Voltar a página de login</h3>                        
            <button class="botao bordaBotao margemBotaoVoltar" onclick="login()">
                <a>Voltar</a> 
            </button>                                 
        </main>
        <footer>
            <p>© Biblioteca do Bairro - Todos os direitos reservados</p>
            <p>Desenvolvido por Antônio Mariano</p>
        </footer> 
    </body>
</html>      