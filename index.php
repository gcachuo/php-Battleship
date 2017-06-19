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
        try {
            register_shutdown_function([$this, "fatal_handler"]);
            if (empty($_GET)) {
                header("Location: /?m=login");
                exit;
            }
            $name = $_GET['m'];
            $this->_controller = $this->callController($name);
            $this->_view = $this->callView($name);
            print $this->_view;
        } catch (Exception $ex) {
            print $ex->getMessage();
        }
    }

    function callController($name)
    {
        if (file_exists("controller/$name.php")) {
            include_once "controller/$name.php";
            $nameController = "controller\\$name";
            return new $nameController();
        } else return null;
    }

    function callView($view)
    {
        $controller = $this->_controller;
        ob_start();
        if (file_exists("view/$view.phtml")) {
            include_once "view/$view.phtml";
            $body = ob_get_contents();
            ob_end_clean();
        } else $body = "La pagina no existe";
        include_once "view/template.phtml";
        $View = ob_get_contents();
        ob_end_clean();
        return $View;
    }

    function fatal_handler()
    {
        $errfile = "unknown file";
        $errstr = "shutdown";
        $errno = E_CORE_ERROR;
        $errline = 0;

        $error = error_get_last();

        if ($error !== NULL) {
            $errno = $error["type"];
            $errfile = addslashes($error["file"]);
            $errline = $error["line"];
            $errstr = "[$errline][$errfile] " . preg_replace("/\r|\n/", " ", addslashes($error["message"]));
            print "<script>console.error('$errstr')</script>";
        }
    }
}