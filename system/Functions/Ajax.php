<?php

/*
 * Função que retorna a box de mensagens do Ajax
 */

if (!function_exists('box_ajax')) {

    function box_ajax()
    {
        return Session::box_ajax_msg();
    }

}

