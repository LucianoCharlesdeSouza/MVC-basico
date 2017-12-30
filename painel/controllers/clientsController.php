<?php

class clientsController extends Controller {

    public function index() {
        $dados = [];
        $this->loadTemplate("Clientes/index", $dados);
    }

}
