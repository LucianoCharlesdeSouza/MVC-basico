<?php

/*
 * Função que retorna o array de configurações do arquivo database.php
 * da pasta config, conforme o valor do indice environment do arquivo
 * environment.php da mesma pasta
 */
if (!function_exists('database')) {

    function database($key = null)
    {

        $app = include 'config/database.php';

        if ($app['environment'] === 'development') {

            return (isset($key)) ? $app['connections']['development'][$key] : $app['connections']['development'];
        }

        return (isset($key)) ? $app['connections']['production'][$key] : $app['connections']['production'];
    }

}

/*
 * Função que retorna o array de configurações do arquivo environment.php
 * da pasta config
 */
if (!function_exists('environment')) {

    function environment($key)
    {

        $app = include 'config/environment.php';

        return $app[$key];
    }

}

/*
 * Função que retorna a URL do projeto
 */
if (!function_exists('base_url')) {

    function base_url($path = null)
    {

        $url = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']);

        if ($path == null) {
            return $url;
        }

        return $url . $path;
    }

}

/*
 * Função que retorna uma URL
 */
if (!function_exists('back_url')) {

    function back_url($path = null)
    {

        if ($path == null) {
            return str_replace(basename(dirname($_SERVER['SCRIPT_FILENAME'])), '', base_url());
        }

        return str_replace(basename(dirname($_SERVER['SCRIPT_FILENAME'])), '', base_url($path));
    }

}

/*
 * Função que aplica o htmlentities() para proibir a execução de scripts
 * maliciosos nas views
 */
if (!function_exists('html')) {

    function html($data)
    {
        $data = str_replace('<script>', '', str_replace('</script>', '', str_replace('<?php', '', str_replace('?>', '', $data))));

        return htmlentities($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    }

}

/*
 * Função que retorna o valor do REQUEST (GET/POST) caso exista
 */
if (!function_exists('requestValue')) {

    function requestValue($name)
    {
        return (isset($_REQUEST[$name])) ? $_REQUEST[$name] : '';
    }

}
