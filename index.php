<?php 

session_start();

//traz o que o projeto precisa
require_once("vendor/autoload.php");
//qual classe eu quero
use \Slim\Slim;



//nova rota
$app = new Slim();

$app->config('debug', true);

require_once("site.php");//chama os arquivos com suas rotas separados por categoria, exemplo: rotas do site no arquivo site e rotas de adm no arquivo de adm
require_once("admin.php");
require_once("admin-user.php");
require_once("admin-categories.php");
require_once("admin-products.php");
require_once("functions.php");//para puxar as funcoes

//se nao existe a pagina vai para a inical
//depois vou adicionar uma 404








$app->run();

?>