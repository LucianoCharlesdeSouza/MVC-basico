<?php

/**
 * Class Alert
 *
 * @author Luciano Charles de Souza
 * E-mail: souzacomprog@gmail.com
 * Github: https://github.com/LucianoCharlesdeSouza
 * YouTube: https://www.youtube.com/channel/UC2bpyhuQp3hWLb8rwb269ew?view_as=subscriber
 */
class Alert
{

    public static function AjaxSuccess($descricao, $titulo = "")
    {
        if ($titulo != ""):
            return ["alert alert-success", "fa fa-check", $titulo, $descricao];
        endif;

        return ["alert alert-success", "fa fa-check", " Sucesso!", $descricao];
    }

    public static function AjaxInfo($descricao, $titulo = "")
    {
        if ($titulo != ""):
            return ["alert alert-info", "fa fa-info", $titulo, $descricao];
        endif;
        return ["alert alert-info", "fa fa-info", " Informação!", $descricao];
    }

    public static function AjaxWarning($descricao, $titulo = "")
    {
        if ($titulo != ""):
            return ["alert alert-warning", "fa fa-warning", $titulo, $descricao];
        endif;
        return ["alert alert-warning", "fa fa-warning", " Atenção!", $descricao];
    }

    public static function AjaxDanger($descricao, $titulo = "")
    {
        if ($titulo != ""):
            return ["alert alert-danger", "fa fa-ban", $titulo, $descricao];
        endif;
        return ["alert alert-danger", "fa fa-ban", " Cuidado!", $descricao];
    }

    public static function AjaxRedirect($praOnde, $tempo = null)
    {
        if ($tempo != null):
            return [$praOnde, $tempo];
        endif;
        return [$praOnde, 3200];
    }

}
