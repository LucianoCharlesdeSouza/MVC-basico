<?php

class errorController extends Controller {

    public function index() {
        $dados = [];

        $this->loadTemplate('error_404', $dados);
    }

}
