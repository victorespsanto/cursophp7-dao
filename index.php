<?php 

require_once("config.php");

// carregando apenas um usuário do banco de dados...

/*$root = new Usuario();

$root->loadById(5);

echo $root;*/

//=====================================================

// carregando a lista de todos os dados do banco de dados...

/*$lista = Usuario::getLista();

echo json_encode($lista);*/

//====================================================

// carrega uma lista com busca de detalhes do nome dos usuarios...

/*$users = Usuario::search("f");

echo json_encode($users);*/

//======================================================

// carrega uma lista com busca de usuarios...

/*$login = new Usuario();

$login->login("Alfredo", "22457");

echo $login;*/

//=======================================================


// teste para inserção de novos dados no baco de dados ok bem sucedido com o entendimento da matéria.

/*$novoUsuario = new Sql();

$novoUsuario->query("INSERT INTO tb_usuarios (deslogin, dessenha) VALUES (:LOGIN, :SENHA)", array(

	':LOGIN'=>"Victor",
	':SENHA'=>"jVitor16"
));

echo "Inserido OK!!"*/

//========================================================


$aluno = new Usuario();

$aluno->setDeslogin("aluno");
$aluno->setDessenha('@lun@');

$aluno->insert();

echo $aluno;

 ?>