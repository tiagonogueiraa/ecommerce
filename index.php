<?php 

session_start();

//traz o que o projeto precisa
require_once("vendor/autoload.php");
//qual classe eu quero
use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;


//nova rota
$app = new Slim();

$app->config('debug', true);
//chamar meu site sem rota venha para aqui e carrega a paginas
$app->get('/', function() {

	$page = new Page();

	$page->setTpl("index");

	//$sql = new Hcode\DB\Sql();

	//$results = $sql->select("SELECT * FROM tb_users");

//	echo json_encode($results);

});

//rota do link de administracao
$app->get('/admin', function() {

	//verifica se a pessoa está logada

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");

	//$sql = new Hcode\DB\Sql();

	//$results = $sql->select("SELECT * FROM tb_users");

//	echo json_encode($results);

});

$app->get('/admin/login', function() {

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login");
});

$app->post('/admin/login', function() {

//classe chama o metodo 
	User::login($_POST["login"], $_POST["password"]);

	header("Location: /admin");
	exit;

});

$app->get('/admin/logout', function(){

	User::logout();

	header("Location: /admin/login");
	exit;
});

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





$app->run();

 ?>