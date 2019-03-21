<?php 

use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;
use \Hcode\Model\Category;

$app->get("/admin/categories", function(){

	User::verifyLogin();

	$categories = Category::listAll();

	$page = new PageAdmin([
		
	]);

	$page->setTpl("categories", [
		"categories"=>$categories
	]);


});


$app->get("/admin/categories/create", function(){

	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("categories-create");

});


$app->post("/admin/categories/create", function(){

	User::verifyLogin();

	$category = new Category();

	$category->setData($_POST);

	$category->save();

	header('Location: /admin/categories');
	exit;
});

$app->get("/admin/categories/:idcategory/delete", function($idcategory){

	User::verifyLogin();
	
	$category = new Category();

	$category->get((int)$idcategory);

	$category->delete();

	header('Location: /admin/categories');
	exit;

});

$app->get("/admin/categories/:idcategory", function($idcategory){

	User::verifyLogin();

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new PageAdmin();

	$page->setTpl("categories-update", [
		"category"=>$category->getValues()
	]);

});


$app->post("/admin/categories/:idcategory", function($idcategory){

	User::verifyLogin();
	
	$category = new Category();

	//coloca o int pois tudo que vem do get está em string
	$category->get((int)$idcategory);

	//CARREGA OS DADOS ATUAIS E COLOCA OS NOVOS DADOS 
	$category->setData($_POST);

	$category->save();

	header('Location: /admin/categories');
	exit;

});

$app->get("/categories/:idcategory", function($idcategory){

	//já tem a classe então vamos recuperar o id que foi passado por get

	$category = new Category();

	$category->get((int)$idcategory);

	$page = new Page();
	//desenho a pagina com os dados que vierem do banco 
	$page->setTpl("category", [
		'category'=>$category->getValues(),
		'products'=>[]
	]);

});

 ?>