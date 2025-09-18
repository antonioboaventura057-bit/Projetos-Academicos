<?php

//Importações de arquivos
require "Livro.php";

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
        $nome = $_POST['nome'];
        $estilo = $_POST['estilo'];

        //Instância um objeto do tipo Livro, altera seus atributos e obtem os seus atributos
        $livro = new Livro();

        $livro->setNome($nome);
        $livro->setEstilo($estilo);

        $nomeLivro = $livro->getNome();
        $estiloLivro = $livro->getEstilo();
        

        //Query SQL de insert do livro
	    $queryCadastro = "INSERT INTO livro (nome, estilo, disponivel) 
        VALUES ('$nomeLivro', '$estiloLivro', 0); ";
        

        //Conecta com a base de dados e depois executa a query SQL insert
        $cadastrar = mysqli_query($conecta, $queryCadastro);

        //Redireciona para a página de listagem de livros
        header('Location: ../livroListagem.php');

    } else if ( $operacao == "alteracao" ){

        //Obtém os dados do formulário
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $estilo = $_POST['estilo'];

        //Instância um objeto do tipo Livro, altera seus atributos e obtem os seus atributos
        $livro = new Livro();

        $livro->setNome($nome);
        $livro->setEstilo($estilo);

        $nomeLivro = $livro->getNome();
        $estiloLivro = $livro->getEstilo();

        //Query SQL de atualização do livro
        $queryAlteracao = "UPDATE livro SET nome = '$nomeLivro', estilo = '$estiloLivro'
        WHERE ID = '$id'; ";

        //Executa a query SQL de atualização do livro
        $atualizar = mysqli_query($conecta, $queryAlteracao);

        //Redireciona para a página de listagem de livros
        header('Location: ../livroListagem.php');

    } else if ( $operacao == "exclusao" ){

        //Obtém os dados do formulário
        $id = $_POST['id'];        
        $disponivel = $_POST['disponivel'];

        //Instância um objeto do tipo Livro e altera seus atributos
        $livro = new Livro();

        $livro->setId($id);
        $livro->setDisponivel($disponivel);

        //Exclui normalmente o livro selecionado
        if( $livro->getDisponivel() == 0 ){

            //Obtém o ID do objeto livro
            $idLivro = $livro->getId();            
    
            //Query SQL de exclusão do livro
            $queryExclusao = "DELETE FROM livro WHERE ID = '$idLivro'; ";
    
            //Executa a query SQL de exclusão do livro
            $excluir = mysqli_query($conecta, $queryExclusao);
    
            //Redireciona para a página de listagem de livros
            header('Location: ../livroListagem.php');            

        } else if ( $livro->getDisponivel() == 1 ){

            //Rediciona para a página de erro de exclusão de livro
            header('Location: ../livroExcluirErro.php');
        }
        
    } 

?>