<?php 

namespace Hcode\Model;

use \Hcode\DB\Sql;
use \Hcode\Model;

class User extends Model {

	//CRIAR UMA CONSTANTE SESSAO

	const SESSION = "User";

	public static function login($login, $password)
	{
		$sql = new Sql();

		$results = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
			":LOGIN"=>$login
		));

		if (count($results) === 0)
		{
			//exceção está no escopo principal(namespace principal php) e não no model, poir isso o \(contrabarra ) para achar o exception
			throw new \Exception("Usuário inexistente ou senha inválida.");			
		}

		$data = $results[0];

		if (password_verify($password, $data["despassword"]) === true)
		{
			$user = new User();


			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;

		} else {

			//exceção está no escopo principal(namespace principal php) e não no model, poir isso o \(contrabarra ) para achar o exception
			throw new \Exception("Usuário inexistente ou senha inválida.");			

		}


	}

	public static function verifyLogin($inadmin = true)
	{
		//SE A SESSION NAO FOR DEFINIDA VOLTA PARA O LOGIN
		if (!isset($_SESSION[User::SESSION]) || !$_SESSION[User::SESSION]
		|| !(int)$_SESSION[User::SESSION]["iduser"] > 0 
		|| (bool)$_SESSION[User::SESSION]["inadmin"] !== $inadmin
	)
		{
			header("Location: /admin/login");
			exit;
		}
	}

	public static function logout()
	{

		$_SESSION[User::SESSION] = NULL;
	}



}

?>