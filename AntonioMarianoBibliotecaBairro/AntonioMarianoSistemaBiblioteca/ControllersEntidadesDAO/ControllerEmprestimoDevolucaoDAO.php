<?php

//Importações de arquivos
require "EmprestimoDevolucao.php";
require "Leitor.php";
require "Livro.php";

	//Faz a conexão com o banco de dados
	$conecta = mysqli_connect(
		'localhost',	//Endereço do banco 
        'root',			//Usuário banco
        '', 			//Senha do banco
        'biblioteca'	//Nome do banco de dados
	); 

    //Seleciona a base de dados
    mysqli_select_db($conecta, 'biblioteca');

    //Obtém a operação do formulário
    $operacao = $_POST['operacao'];

    //Executa a operação de acordo com a operação obtida no formulário
    if( $operacao == "emprestimo" ){
        
        //Obtém os dados do formulário
        $idLeitor = $_POST['leitor'];
        $idLivro = $_POST['livro'];

        
        //Altera o livro que está sendo retirado        
        $queryAlteracaoLivro = "UPDATE livro SET disponivel = 1 WHERE ID = '$idLivro'; ";

        //Executa a query SQL de atualização do livro
        $atualizarLivro = mysqli_query($conecta, $queryAlteracaoLivro);
        

        //Altera o leitor que está retirando o livro
        //Lista a quantidade de livros do leitor que está retirando o livro
        $querySelectLeitor = "SELECT quantidade_livros FROM leitor WHERE ID = '$idLeitor'; ";

        //Executa a query SQL de select do leitor
        $resultadoSelectLeitor = mysqli_query($conecta, $querySelectLeitor);

        //Declaração da variável nova quantidade de livros
        $novaQuantidadeLivros;
        
        //Escreve cada linha da tabela do banco
        /*A função mysqli_fetch_array percorre linha por linha da váriavel 
        resultadoSelectLeitor e armazena cada linha em um array*/
        if( $arrayLeitor = mysqli_fetch_array ($resultadoSelectLeitor) ){

            //Acrescenta + 1 livro na quantidade de livros que o leitor retirou
            $novaQuantidadeLivros = $arrayLeitor[0] + 1;
        }

        //Atualiza a quantidade de livros que o leitor retirou        
        $queryAlteracaoLeitor = "UPDATE leitor SET quantidade_livros = '$novaQuantidadeLivros'
        WHERE ID = '$idLeitor'; ";

        //Executa a query SQL de atualização do leitor
        $atualizarLeitor = mysqli_query($conecta, $queryAlteracaoLeitor);
        

        //Define o valor dos demais atributos da entidade Emprestimo_Devolucao_Livro
        $acao = "Retirada";
        $quantidadeDias = 0;
        $valorMulta = 0.00;
        /*O método date obtém a data atual (nesse caso está formatado para obter 
        a data atual no padrão americano)*/
        $dataEmprestimo = date('Y-m-d');               
        /*Realiza a soma da data atual obtida anteriormente com uma quantidade inteira de dias
        (no caso são somados 3 dias na data atual)*/
        /*O método strtotime recebe parâmetros relativos a data e transforma com base
        neles em uma data real*/
        $prazoDevolucao = date('Y-m-d', strtotime("+3 days", strtotime($dataEmprestimo) ) );
        
        /*Instância um objeto do tipo EmprestimoDevolucao, 
        altera seus atributos e obtem os seus atributos*/
        $emprestimo = new EmprestimoDevolucao();
        
        $emprestimo->setLeitor($idLeitor);
        $emprestimo->setLivro($idLivro);    
        $emprestimo->setAcao($acao);
        $emprestimo->setQuantidadeDias($quantidadeDias);
        $emprestimo->setValorMulta($valorMulta);
        $emprestimo->setDataEmprestimo($dataEmprestimo);
        $emprestimo->setPrazoDevolucao($prazoDevolucao);

        $idLeitorEmprestimo = $emprestimo->getLeitor();
        $idLivroEmprestimo = $emprestimo->getLivro();
        $acaoEmprestimo = $emprestimo->getAcao();
        $quantidadeDiasEmprestimo = $emprestimo->getQuantidadeDias();
        $valorMultaEmprestimo = $emprestimo->getValorMulta();
        $dataRetiradaEmprestimo = $emprestimo->getDataEmprestimo();
        $prazoDevolucaoEmprestimo = $emprestimo->getPrazoDevolucao();       
        

        //Query SQL de insert do empréstimo
	    $queryEmprestimo = "INSERT INTO emprestimo_devolucao_livro (FK_LEITOR_ID, FK_LIVRO_ID, 
        acao, quantidade_dias, valor_multa, data_emprestimo, prazo_devolucao) 
        VALUES ('$idLeitorEmprestimo', '$idLivroEmprestimo', '$acaoEmprestimo', 
        '$quantidadeDiasEmprestimo', '$valorMultaEmprestimo', '$dataRetiradaEmprestimo',
        '$prazoDevolucaoEmprestimo'); ";        
        
        //Conecta com a base de dados e depois executa a query SQL insert
        $cadastrarEmprestimo = mysqli_query($conecta, $queryEmprestimo);

        //Redireciona para a página de listagem de empréstimos
        header('Location: ../emprestimoDevolucaoListagem.php');
        
    } else if ( $operacao == "devolucao" ){
        
        //Obtém os dados do formulário
        $idEmprestimoDevolucao = $_POST['idEmprestimoDevolucao'];

        //Faz a listagem do empréstimo/devolução de livros selecionado no formulário
        $selectEmprestimoDevolucao = "SELECT edl.ID idEDL, edl.acao acaoEDL, edl.quantidade_dias quantidadeDiasEDL,
        edl.valor_multa valorMultaEDL, edl.data_emprestimo dataEmprestimoEDL,
        edl.prazo_devolucao prazoDevolucaoEDL, edl.data_devolucao dataDevolucaoEDL,
        le.ID idLeitor, le.quantidade_livros quantidadeLivrosLeitor,
        li.ID idLivro, li.disponivel disponivelLivro    
        FROM livro li, leitor le, emprestimo_devolucao_livro edl
        WHERE edl.ID = '$idEmprestimoDevolucao' 
        AND edl.FK_LEITOR_ID = le.ID AND edl.FK_LIVRO_ID = li.ID; ";

        //Executa a query SQL de select do empréstimo/devolução de livros selecionado no formulário
        $resultadoSelect = mysqli_query($conecta, $selectEmprestimoDevolucao);

        //Instância um objeto do tipo EmprestimoDevolucao
        $devolucao = new EmprestimoDevolucao();

        //Instância um objeto do tipo Livro
        $livro = new Livro();

        //Instância um objeto do tipo Leitor
        $leitor = new Leitor();

        /*A função mysqli_fetch_array percorre linha por linha da 
        váriavel resultadoObtido e armazena cada linha em um array*/
        if( $arrayEmprestimoDevolucao = mysqli_fetch_array ($resultadoSelect) ){
            
            $devolucao->setId($arrayEmprestimoDevolucao[0]);
            $devolucao->setAcao($arrayEmprestimoDevolucao[1]);
            $devolucao->setQuantidadeDias($arrayEmprestimoDevolucao[2]);
            $devolucao->setValorMulta($arrayEmprestimoDevolucao[3]);
            $devolucao->setDataEmprestimo($arrayEmprestimoDevolucao[4]);
            $devolucao->setPrazoDevolucao($arrayEmprestimoDevolucao[5]);
            $devolucao->setDataDevolucao($arrayEmprestimoDevolucao[6]);

            $leitor->setId($arrayEmprestimoDevolucao[7]);
            $leitor->setQuantidadeLivros($arrayEmprestimoDevolucao[8]);

            $livro->setId($arrayEmprestimoDevolucao[9]);
            $livro->setDisponivel($arrayEmprestimoDevolucao[10]);            
        }

        $idEmprestimoDevolucao = $devolucao->getId();
        $acao = $devolucao->getAcao();
        $quantidadeDias = $devolucao->getQuantidadeDias();
        $valorMulta = $devolucao->getValorMulta();
        $dataEmprestimo = $devolucao->getDataEmprestimo();
        $prazoDevolucao = $devolucao->getPrazoDevolucao();
        $dataDevolucao = $devolucao->getDataDevolucao();

        $idLeitor = $leitor->getId();
        $quantidadeLivrosLeitor = $leitor->getQuantidadeLivros();

        $idLivro = $livro->getId();
        $disponivelLivro = $livro->getDisponivel();

        //Caso a devolução seja inválida
        if($acao == "Devolução" || $disponivelLivro == 0 || $quantidadeLivrosLeitor == 0){

            //Redireciona para a página de erro de devolução
            header('Location: ../devolucaoErro.php');

          //Caso a devolução seja válida    
        } else if($acao == "Retirada" || $disponivelLivro == 1 || $quantidadeLivrosLeitor > 0){
            
            //Altera o livro que está sendo devolvido        
            $queryAlteracaoLivro = "UPDATE livro SET disponivel = 0 WHERE ID = '$idLivro'; ";

            //Executa a query SQL de atualização do livro
            $atualizarLivro = mysqli_query($conecta, $queryAlteracaoLivro);


            //Altera o leitor que está devolvendo o livro           
            //Declaração da variável nova quantidade de livros do leitor
            $novaQuantidadeLivros;
            
            //Diminui - 1 livro na quantidade de livros que o leitor está no momento
            $novaQuantidadeLivros = $quantidadeLivrosLeitor - 1;            

            //Atualiza a quantidade de livros que o leitor está no momento        
            $queryAlteracaoLeitor = "UPDATE leitor SET quantidade_livros = '$novaQuantidadeLivros'
            WHERE ID = '$idLeitor'; ";

            //Executa a query SQL de atualização do leitor
            $atualizarLeitor = mysqli_query($conecta, $queryAlteracaoLeitor);
            

            //Atualiza as variáveis da entidade Emprestimo_Devolucao_Livro
            $acao = "Devolução";
            $dataDevolucao = date('Y-m-d');

            //Declaração da variável diferença em segundos das datas
            $diferençaSegundosDatas;

            //Calcula a diferença de segundos entre a data de devolução e data de empréstimo
            //Diferença em segundo = Data maior - Data menor
            //O método strtotime, nesse caso, obtém o número de segundos de cada uma das datas 
            $diferençaSegundosDatas = strtotime($dataDevolucao) - strtotime($dataEmprestimo);
            
            /*Como cada dia tem 86400 segundo e o método strtotime obtém o número de segundos 
            de cada data e anteriormente foram substraídos o número de segundos de cada um das
            datas. Obteve-se a diferença de segundos entre as datas. Com isso para transformar
            essa diferença para dias, deve-se dividir o resultado obtido anteriormente por
            86400*/
            $quantidadeDias = $diferençaSegundosDatas / 86400;
            
            //Atualiza o valor da multa de acordo com a quantidade de dias de atraso
            if( $quantidadeDias > 3 ){

                $valorMulta = (($quantidadeDias - 3) * 1.50);
                
            } else if( $quantidadeDias <= 3 ){
                
                $valorMulta = 0.00;                
            }


            //Query SQL de atualização do registro de empréstimo/devolução
            $queryAlteracaoEmprestimo = "UPDATE emprestimo_devolucao_livro SET 
            acao = '$acao', quantidade_dias = '$quantidadeDias', valor_multa = '$valorMulta',
            data_devolucao = '$dataDevolucao' WHERE ID = '$idEmprestimoDevolucao'; ";

            //Executa a query SQL de atualização do empréstimo/devolução
            $atualizarEmprestimo = mysqli_query($conecta, $queryAlteracaoEmprestimo);

            //Redireciona para a página de listagem de empréstimos e devoluções
            header('Location: ../emprestimoDevolucaoListagem.php');                
            
        }

    } 

?>