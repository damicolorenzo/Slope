<?php

require('/opt/lampp/htdocs/Slope/libs/Smarty/Smarty.class.php');

class StartSmarty {

    static function configuration() {
        $smarty = new Smarty();
        $smarty->template_dir = '/opt/lampp/htdocs/Slope/libs/Smarty/templates/';
        $smarty->compile_dir = '/opt/lampp/htdocs/Slope/libs/Smarty/templates_c/';
        $smarty->config_dir = '/opt/lampp/htdocs/Slope/libs/Smarty/configs/';
        $smarty->cache_dir = '/opt/lampp/htdocs/Slope/libs/Smarty/cache/';
        return $smarty;
    }

}

?>