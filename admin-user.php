<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app->get("/admin/users", function(){

	//para essa tela precisa estar logado no sistema 
	User::verifyLogin();

	//criar rotina para chamar a lista do banco de dados 

	$users = User::listAll();

	$page = new PageAdmin();

	$page->setTpl("users", array(
		"user"=>$users
	));
});

$app->get("/admin/users/create", function(){

	//para essa tela precisa estar logado no sistema 
	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("users-create");
});

//chamando a rota e o delete
$app->get("/admin/users/:iduser/delete", function($iduser){

	User::verifyLogin();

	$user = new user();

	$user->get((int)$iduser);

	$user->delete();

	header("Location: /admin/users");
	exit;

});

//o valor que vem no get entra na variavel funcao que nesse caso é o atributo iduser
$app->get("/admin/users/:iduser", function($iduser){

	//para essa tela precisa estar logado no sistema 
	User::verifyLogin();

	$user = new User();

	$user->get((int)$iduser);

	$page = new PageAdmin();

	$page->setTpl("users-update", array (
		"user"=>$user->getValues()
	));
	
});
//rota que recebe post
$app->post("/admin/users/create", function() {

	User::verifyLogin();

	$user = new User();

	$_POST['despassword'] = password_hash($_POST["despassword"], PASSWORD_DEFAULT, [

		"cost"=>12

	]);

	//se estiver marcado o checbox do administrador então inadmin é 1 se não é 0
	$_POST["inadmin"] = (isset($_POST['inadmin']))?1:0;

	// METODO SET DATA, ELE CRIA AUTOMATICAMENTE AS VARIAVEIS PARA O DAO, 
	$user->setData($_POST);

	$user->save();

	header("Location: /admin/users");
	exit;


});

$app->post("/admin/users/:iduser", function($iduser){

	User::verifyLogin();

	$user = new User();

	$_POST["inadmin"] = (isset($_POST['inadmin']))?1:0;


	//carreagar os dados
	$user->get((int)$iduser);

	//seta os dados do post
	$user->setData($_POST);

	$user->update();

	header("Location: /admin/users");
	exit;

});


 ?>