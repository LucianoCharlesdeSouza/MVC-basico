<?php

/*
 * Função que retorna a box de mensagens do Ajax
 */

if (!function_exists('boxAjax')) {

    function boxAjax()
    {
        return Session::boxAjaxMsg();
    }

}

