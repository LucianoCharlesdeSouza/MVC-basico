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

/*
 * Função que retorna os atributos necessário ao motor Ajax
 */
if (!function_exists('ajaxForm')) {

    function ajaxForm($controller, $class = null)
    {
        return 'class="ajaxForm ' . $class . '" data-controller="' . $controller . '"';
    }

}

/*
 * Função que retorna botão usado na requisição Ajax
 */
if (!function_exists('btnAjaxForm')) {

    function btnAjaxForm($value, $class = null)
    {
        return '<button class="' . $class . '"><i class="btnAjaxForm fa "></i>' . $value . '</button>';
    }

}

/*
 * Função que retorna botão usado para deletar na requisição Ajax
 */
if (!function_exists('btnDeleteAjax')) {

    function btnDeleteAjax($controller, $id, $value = 'Excluir', $class = null)
    {
        return '<button class="ajaxDelete ' . $class . '" data-controller="' . $controller . '" id="' . $id . '">' . $value . '</button>';
    }

}
