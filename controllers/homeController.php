<?php

class homeController extends Controller {

    public function index() {
        $dados = [];
        $this->loadTemplate('home', $dados);
    }

}
