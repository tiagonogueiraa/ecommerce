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


$app->run();

 ?>