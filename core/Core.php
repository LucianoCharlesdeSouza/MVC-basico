<?php
/**
 * Class Core
 * 
 * @author Bonieky Lacerda
 * Site: http://b7web.com.br
 */
class Core
{

    /**
     * Método responsável por resolver os dados da URL
     */
    public function run()
    {
        $url = '/';
        if (isset($_GET['url'])) {
            $url .= rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
        }

        $params = array();
        if (!empty($url) && $url != '/') {
            $url = explode('/', $url);
            array_shift($url);

            $currentController = $url[0] . 'Controller';
            array_shift($url);

            if (isset($url[0]) && !empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }

            if (count($url) > 0) {
                $params = $url;
            }
        } else {
            $currentController = 'homeController';
            $currentAction = 'index';
        }

        if (!file_exists('controllers/' . $currentController . '.php') || !method_exists($currentController, $currentAction)):
            $c = new notFoundController();
            $currentAction = 'index';
            http_response_code(404);
        else:
            $c = new $currentController();
        endif;

        call_user_func_array(array($c, $currentAction), $params);
    }

}
