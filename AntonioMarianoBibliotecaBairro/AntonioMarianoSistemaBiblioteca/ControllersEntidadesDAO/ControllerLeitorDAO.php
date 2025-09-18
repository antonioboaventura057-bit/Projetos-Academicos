<?php

//Importações de arquivos
require "Leitor.php";

	//Faz a conexão com o banco de dados
	$conecta = mysqli_connect(
		'localhost',	//Endereço do banco 
        'root',			//Usuário banco
        '', 			//Senha do banco
        'biblioteca'	//Nome do banco de dados
	); 

    //Obtém a operação do formulário
    $operacao = $_POST['operacao'];

    //Executa a operação de acordo com a operação obtida no formulário
    if( $operacao == "cadastro" ){

        //Obtém os dados do formulário
        $nomeCompleto = $_POST['nomeCompleto'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $foto = $_FILES['foto'];

        //Instância um objeto do tipo Leitor, altera seus atributos e obtem os seus atributos
        $leitor = new Leitor();

        $leitor->setNomeCompleto($nomeCompleto);
        $leitor->setCpf($cpf);
        $leitor->setTelefone($telefone);
        $leitor->setFoto($foto);

        $nomeCompletoLeitor = $leitor->getNomeCompleto();
        $cpfLeitor = $leitor->getCpf();
        $telefoneLeitor = $leitor->getTelefone();
        $fotoLeitor = $leitor->getFoto();        

        //Query SQL de insert do leitor
	    $queryCadastro = "INSERT INTO leitor (nome_completo, CPF, telefone, foto,
        quantidade_livros) VALUES ('$nomeCompletoLeitor', '$cpfLeitor', '$telefoneLeitor',
        '$fotoLeitor', 0); ";
        
        //Conecta com a base de dados e depois executa a query SQL insert
        $cadastrar = mysqli_query($conecta, $queryCadastro);

        //Redireciona para a página de listagem de leitores
        header('Location: ../leitorListagem.php');

    } else if ( $operacao == "alteracao" ){
        
        //Obtém os dados do formulário
        $id = $_POST['id'];
        $nomeCompleto = $_POST['nomeCompleto'];
        $cpf = $_POST['cpf'];
        $telefone = $_POST['telefone'];
        $foto = $_FILES['foto'];

        //Instância um objeto do tipo Leitor, altera seus atributos e obtem os seus atributos
        $leitor = new Leitor();

        $leitor->setId($id);
        $leitor->setNomeCompleto($nomeCompleto);
        $leitor->setCpf($cpf);
        $leitor->setTelefone($telefone);
        $leitor->setFoto($foto);        

        $idLeitor = $leitor->getId();
        $nomeCompletoLeitor = $leitor->getNomeCompleto();
        $cpfLeitor = $leitor->getCpf();
        $telefoneLeitor = $leitor->getTelefone();
        $fotoLeitor = $leitor->getFoto();

        //Query SQL de atualização do leitor
        $queryAlteracao = "UPDATE leitor SET nome_completo = '$nomeCompletoLeitor',
        CPF = '$cpfLeitor', telefone = '$telefoneLeitor', foto = '$fotoLeitor'
        WHERE ID = '$idLeitor'; ";

        //Executa a query SQL de atualização do leitor
        $atualizar = mysqli_query($conecta, $queryAlteracao);
        
        //Redireciona para a página de listagem de leitores
        header('Location: ../leitorListagem.php');
        
    } else if ( $operacao == "exclusao" ){
        
        //Obtém os dados do formulário
        $id = $_POST['id'];        
        $quantidadeLivros = $_POST['quantidadeLivros'];

        //Instância um objeto do tipo Leitor e altera seus atributos
        $leitor = new Leitor();

        $leitor->setId($id);
        $leitor->setQuantidadeLivros($quantidadeLivros);

        //Exclui normalmente o leitor selecionado
        if( $leitor->getQuantidadeLivros() == 0 ){

            //Obtém o ID do objeto leitor
            $idLeitor = $leitor->getId();            
    
            //Query SQL de exclusão do leitor
            $queryExclusao = "DELETE FROM leitor WHERE ID = '$idLeitor'; ";
    
            //Executa a query SQL de exclusão do leitor
            $excluir = mysqli_query($conecta, $queryExclusao);
    
            //Redireciona para a página de listagem de leitores
            header('Location: ../leitorListagem.php');            

        } else if ( $leitor->getQuantidadeLivros() > 0 ){

            //Rediciona para a página de erro de exclusão de leitor
            header('Location: ../leitorExcluirErro.php');
        }
        
    } 

?>