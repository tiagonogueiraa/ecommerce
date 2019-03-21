<?php 

use \Hcode\Model\Product;
use \Hcode\Page;

$app->notFound( function() {

	$page = new Page();

	$page->setTpl("index");
});

//chamar meu site sem rota venha para aqui e carrega a paginas
$app->get('/', function() {

	$products = Product::listAll();

	$page = new Page();

	$page->setTpl("index", [
		'products'=>Product::checkList($products)

	]);

	//$sql = new Hcode\DB\Sql();

	//$results = $sql->select("SELECT * FROM tb_users");

//	echo json_encode($results);

});


 ?>