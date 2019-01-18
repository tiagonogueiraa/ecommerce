<?php 


namespace Hcode;

use Rain\Tpl;

class Page {

	//declarar
	private $tpl;
	private $options = [];
	private $defaults = [
		"data"=>[]

	];

	public function __construct($opts = array()){

 		// um sobreescreve o outro, e o construct sobressai o defaults e vale o opts
	$this->options = array_merge($this->defaults, $opts);

		// config
	$config = array(
					"tpl_dir"       => $_SERVER['DOCUMENT_ROOT']."/views/",
					"cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/views-cache/",
					"debug"         => false // set to false to improve the speed
					//NAO PRECISA DESSA PARTE, ou coloque false. | "debug"         => true // set to false to improve the speed
				   );

	Tpl::configure($config);

	//criar o tpl
	$this->tpl = new Tpl;

	//otimizado
	$this->setData($this->options["data"]);


	//foreach ($this->options["data"] as $key => $value) {
		# code...
		//recebe os arrays que sao as variaveis options ou defaults
	//	$this->tpl->assign($key,$value);

	//}

	//desenhar o template na tela
	//draw eh uma funcao do tpl
	$this->tpl->draw("header");


	}	

	public function setTpl($name, $data = array(), $returnHTML = false)
	{
		
		$this->setData($data);

		return $this->tpl->draw($name, $returnHTML);

	

}

	private function setData($data = array())
	{
		foreach ($data as $key => $value) {
		# code...
		//recebe os arrays que sao as variaveis options ou defaults
		$this->tpl->assign($key,$value);

	}
	}
	

	public function __destruct(){

		$this->tpl->draw("footer");

	}
}



 ?>