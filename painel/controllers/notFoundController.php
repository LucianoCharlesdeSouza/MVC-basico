<?php

class notFoundController extends Controller
{

    public function index()
    {
        $this->loadView('notFound');
    }

    public function unauthorized()
    {
        http_response_code(401);
        $this->loadView('unauthorized');
    }

}
