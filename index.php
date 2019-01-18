<?php 
//traz o que o projeto precisa
require_once("vendor/autoload.php");
//qual classe eu quero
use \Slim\Slim;
use \Hcode\Page;
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

$app->run();

 ?>