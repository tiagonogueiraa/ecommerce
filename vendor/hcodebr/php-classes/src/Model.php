<?php 

namespace Hcode;

use Rain\Tpl;

class Model {

	//ter todos os valores que tem no objeto 
	private $values = [];


	//saber quando o metodo é chamado que pode usar o metodo __call que recebe o nome do método e os argumentos
	public function __call($name, $args)
	{

		// verifica se é post ou get
		//a partir da posicao 0, traga 0, 1 e 2
		$method = substr($name, 0, 3);
		$fieldName = substr($name, 3, strlen($name));

		switch ($method) {
			
			case "get":

			//SE EXISTE O VALOR RETORNA ELE, SE NÃO RETORNA NULO
			return (isset($this->values[$fieldName])) ? $this->values[$fieldName] : NULL;

			break;
			case "set":

			return $this->values[$fieldName] =  $args[0];
			
			break;

		}
	}

	public function setData( $data = array())
	{

		foreach ($data as $key => $value) {
			//coloca entre chaves pois eh uma string 
			//coloca dinamicamente precisa do set e o nome do campo.
			$this->{"set".$key}($value);
		}
	}

	public function getValues()
	{
		return $this->values;
	}


}

?>