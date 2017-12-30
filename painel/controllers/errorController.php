<?php

class errorController extends Controller {

    public function index() {
        $data = [];

        $this->loadTemplate('error_404', $dados);
    }

}
