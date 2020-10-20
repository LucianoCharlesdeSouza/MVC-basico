<?php

class notFoundController extends Controller
{

    public function index()
    {
        http_response_code(404);
        $this->loadView('notFound');
    }

    public function unauthorized()
    {
        if (Session::has('ajaxForm')) {
            Session::destroy('ajaxForm');
        }
        http_response_code(401);
        $this->loadView('unauthorized');
    }

}
