<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/style.css">
        <script type="text/javascript" src="navegacao.js"></script>
        <title>Cadastro de leitor</title>
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
            <h1 class="centralizar">Cadastro de leitor</h1>  
            
            <?php

                //Faz a conexão com o banco de dados
                $conecta = mysqli_connect(
                    'localhost',	//Endereço do banco 
                    'root',			//Usuário banco
                    '', 			//Senha do banco
                    'biblioteca'	//Nome do banco de dados
                ); 

                //Valida se foi enviado um arquivo
                //O método isset verifica se o arquivo existe
                //$_FILES armazena arquivos
                if(isset($_FILES['foto'])){

                    //Obtem a extensão do arquivo
                    //O método substr corta o nome do arquivo em duas partes
                    //$_FILES acessa o nome do arquivo
                    /*O parâmetro -4 faz com que sejam obtidos os últimos 4 caracteres 
                    do nome do arquivo (que no caso é a extensão)*/
                    //No fim é armazenada apenas a extensão do arquivo 
                    $extensaoInicial = substr($_FILES['foto']['name'], -4);

                    //O método strtolower converte toda a string (extensão) para minúsculo
                    //Assim é garantido que a extensão do arquivo está correta
                    $extensaoFinal = strtolower($extensaoInicial);

                    //É dado um novo nome para o arquivo 
                    /*O método time retorna a hora atual e o método md5 faz a cripitografia
                    (no caso cripitografa a hora atual)*/
                    //No nome do arquivo é necessário colocar a extensão
                    //Com o comando md5(time()) é garantido que não se tenha arquivo duplicados
                    $nomeFotoAtualizado = md5(time()) . $extensaoFinal;

                    //Cria uma pasta para depois ser salvo o arquivo
                    $local = "fotos/";

                    /*Ao ser enviado um arquivo no PHP, o PHP armazena esse arquivo em um
                    local de arquivos temporarios*/
                    //Então é necessário obter esse arquivo, é o que faz a linha abaixo
                    //O método move_uploaded_file acessa a pasta de arquivos temporarios do PHP
                    //Inicialmente é acessado o arquivo com o nome temporario dele (tmp_name)
                    /*Depois disso o método envia o arquivo para a pasta onde fica salvo
                    definitivamente (local + novo nome do arquivo)*/
                    move_uploaded_file($_FILES['foto']['tmp_name'], $local.$nomeFotoAtualizado);
                }

            ?>

            <form action="ControllersEntidadesDAO/ControllerLeitorDAO.php"
            method="post" enctype="multipart/form-data">

                <input type="hidden" name="operacao" value="cadastro">

                <label>Nome completo:</label>
                <br>
                <input type="text" id="nomeCompleto" name="nomeCompleto" 
                placeholder="Nome completo" minlength="5" maxlength="100" required>
                <br>
                <label>CPF:</label>
                <br>
                <input type="text" id="cpf" name="cpf" placeholder="999.999.999-99" required
                minlength="14" maxlength="14" pattern="\d{3}.\d{3}.\d{3}-\d{2}">
                <br>
                <label>Telefone:</label>
                <br>
                <input type="tel" id="telefone" name="telefone" placeholder="99 99999-9999" 
                required minlength="13" maxlength="13" pattern="\d{2} \d{5}-\d{4}">
                <br><br>
                <label>Foto:</label>
                <br>
                <input type="file" id="foto" name="foto" required> 
                <div>
                    <input class="botao bordaBotao espacoCorBotao" type="submit" 
                    id="cadastroLeitor" name="cadastroLeitor" value="Cadastrar leitor"> 
                    <button class="botao bordaBotao">
                        <a href="leitorListagem.php">Cancelar cadastro</a>
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