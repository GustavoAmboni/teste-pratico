<?php

class Core
{

    public function start($url)
    {

        $method = 'index';

        if (isset($_GET['view'])) {
            $controller = ucfirst($_GET['view'] . 'Controller');
        } else {
            $controller = "HomeController";
        }

        if (isset($_GET['action'])) {
            $method = $_GET['action'];
        }

        if (!class_exists($controller)) {
            $controller = "HomeController";
        }

        try {
            unset($_GET['view'], $_GET['action']);

            $param = $_GET;

            $class = new $controller();
            if (empty($param)) {
                $class->$method();
            } else {
                $class->$method($param);
            }
        } catch (Exception $e) {


            $_SESSION['msg'] = [
                'type' => 'danger',
                'content' => $e->getMessage()
            ];
            header('Location: /');
        }
    }
}
