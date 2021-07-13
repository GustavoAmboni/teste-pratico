<?php

class Controller
{

    public function view($src, $params)
    {

        $params = array_merge($params, $_SESSION);

        unset($_SESSION['msg'], $_SESSION['cliente']);

        extract($params, EXTR_PREFIX_ALL, 'v');

        require_once('Views/' . $src . '.php');
    }
}
