<?php
/**
 * Created by PhpStorm.
 * User: Cachu
 * Date: 18/jun/2017
 * Time: 08:29 PM
 */

new index();

class index
{
    private $_view, $_controller;

    function __construct()
    {
        if (empty($_GET)) {
            header("Location: /?m=login");
            exit;
        }
        $name = $_GET['m'];
        $this->_controller = $this->callController($name);
        $this->_view = $this->callView($name);
        print $this->_view;
    }

    function callController($name)
    {
        require_once "controller/$name.php";
        $nameController = "controller\\$name";
        return new $nameController();
    }

    function callView($view)
    {
        $controller = $this->_controller;
        ob_start();
        require_once "view/$view.phtml";
        $body = ob_get_contents();
        ob_end_clean();
        require_once "view/template.phtml";
        $View = ob_get_contents();
        ob_end_clean();
        return $View;
    }
}