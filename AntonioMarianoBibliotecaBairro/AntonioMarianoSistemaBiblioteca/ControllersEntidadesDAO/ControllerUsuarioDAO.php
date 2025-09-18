<?php

//Importações de arquivos
require "Usuario.php";

	//Faz a conexão com o banco de dados
	$conecta = mysqli_connect(
		'localhost',	//Endereço do banco 
        'root',			//Usuário banco
        '', 			//Senha do banco
        'biblioteca'	//Nome do banco de dados
	); 


	//Obtém os dados do formulário
	$login = $_POST['login'];
    $senha = $_POST['senha'];
    

	//Instância um objeto do tipo Usuário, altera seus atributos e obtem os seus atributos
	$usuario = new Usuario();

	$usuario->setLogin($login);
	$usuario->setSenha($senha);

	$loginUsuario = $usuario->getLogin();
	$senhaUsuario = $usuario->getSenha();


	//Query SQL de login
	$queryLogin = "SELECT u.ID idUsuario, u.login usuarioLogin, u.senha usuarioSenha 
	FROM usuario_admin u 
	WHERE u.login = '$loginUsuario' AND u.senha = '$senhaUsuario'; ";


	//Executa a query SQL
	$resultadoObtido = mysqli_query($conecta, $queryLogin);

	
	/* A função mysqli_num_rows obtem número de linhas 
	que a tabela do banco de dados possui */
    if( mysqli_num_rows($resultadoObtido) == 1 ){

		//Redireciona para a página do usuário administrador
		header('Location: ../loginSucesso.php');		

	} else if( mysqli_num_rows($resultadoObtido) != 1){

		//Redireciona para a página de erro de login
		header('Location: ../loginFalha.php');		
	}

?>