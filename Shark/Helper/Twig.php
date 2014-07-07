<?php
/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
* @filename Twig.php
* @touch date Sat 10 May 2014 12:07:35 AM CST
* @author: Fred<fred.zhou@foxmail.com>
* @license: http://www.zend.com/license/3_0.txt PHP License 3.0"
* @version 1.0.0
*/
namespace Shark\Helper;

class Twig {

/*{{{ variable*/
    private $twig;
    private $app;
/*}}}*/
/*{{{ construct */
    /**
     * Constructor
     * @param  object  $app
     */
    public function __construct() {
        $this->app = \Slim\Slim::getInstance();
        $config = $this->app->config('twig');
         
        if (!class_exists('\Twig_Autoloader')) {
            require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'Twig' . DIRECTORY_SEPARATOR .'Autoloader.php';
        }
 
        \Twig_Autoloader::register();
 
        $loader = new \Twig_Loader_Filesystem($this->app->view->getTemplatesDirectory());
        $this->twig = new \Twig_Environment($loader, array(
            'cache' => $config['cache'],
            'debug' => $this->app->config('debug'),
        ));
        
        foreach(get_defined_functions() as $functions) {
            foreach($functions as $function) {
                $this->twig->addFunction($function, new \Twig_Function_Function($function));
            }
        }
    }
/*}}}*/
/*{{{ render */
    public function render($template, $data) {
        $template = $this->twig->loadTemplate($template);
        return $template->render($data);
    }
/*}}}*/
/*{{{ display */
    public function display($template, $data) {
        $template = $this->twig->loadTemplate($template);
        return $template->display($data);
    }
/*}}}*/

}
