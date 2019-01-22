<?php>

namespace Hcode;


class PageAdmin extends Page {

    public function __construct($opts = array(), $tpl_dir = "/views/admin/")
    {

        // parent:: para falar que está pegando do construtor pai que é 
        // a classe Page extends
    	parent::__construct($opts, $tpl_dir);
    	
    }

}

?>