<?php

class HomeController extends Controller
{

    public function index()
    {

        $params = [
            'page_title' => 'Portaria',
            'title' => 'Sistema de Portaria',
            'box_title' => 'Cadastro',
            'clients' => Cliente::selectAll(),
            'action' => "create"
        ];

        $this->view('Layout', $params);
    }
}
