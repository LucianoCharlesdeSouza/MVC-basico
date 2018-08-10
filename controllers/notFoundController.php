<?php

class notFoundController extends Controller
{

    public function index()
    {
        $dados = [];

        $this->loadView('notFound', $dados);
    }

    public function unauthorized()
    {
        http_response_code(401);
        $this->loadView('unauthorized');
    }

}
