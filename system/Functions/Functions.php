<?php

/*
 * Função que retorna o array de configurações do arquivo database.php
 * da pasta config, conforme o valor do indice environment do arquivo
 * environment.php da mesma pasta
 */
if (!function_exists('database')) {

    function database($key = null)
    {

        $app = include dirname(__DIR__, 2) . '/config/database.php';

        if ($app['environment'] === 'development') {

            return (isset($key)) ? $app['connections']['development'][$key] : $app['connections']['development'];
        }

        return (isset($key)) ? $app['connections']['production'][$key] : $app['connections']['production'];
    }

}

/*
 * Função que retorna o array de configurações do arquivo app.php
 * da pasta config
 */
if (!function_exists('app')) {

    function app($key)
    {

        $app = include dirname(__DIR__, 2) . '/config/app.php';

        return (isset($key)) ? $app[$key] : $app;
    }

}
/*
 * Função que retorna o array de configurações do arquivo environment.php
 * da pasta config
 */
if (!function_exists('environment')) {

    function environment($key = null)
    {

        $app = include dirname(__DIR__, 2) . '/config/environment.php';

        return (isset($key)) ? $app[$key] : $app;
    }

}
/*
 * Função que retorna o array de configurações do arquivo mail.php
 * da pasta config
 */
if (!function_exists('mailer')) {

    function mailer($key = null)
    {

        $app = include dirname(__DIR__, 2) . '/config/mail.php';

        return (isset($key)) ? $app[$key] : $app;
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
 * Função que aplica o htmlentities() para inibir a execução de scripts
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
 * Função que retorna o var_dump formatado
 */
if (!function_exists('dd')) {

    function dd($value)
    {
        echo "<pre>";
        var_dump($value);
        exit();
    }

}