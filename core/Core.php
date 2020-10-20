<?php

/**
 * Class Core
 * 
 * @author Bonieky Lacerda
 * Site: http://b7web.com.br
 */
class Core
{

    public function run()
    {
        $url = $this->url();

        [$currentController, $currentAction] = $this->defaultControllerAndAction();

        $params = [];

        if (!empty($url) && $url !== '/') {
            $url = explode('/', $url);
            array_shift($url);

            $currentController = $url[0] . 'Controller';
            array_shift($url);

            if (!empty($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            }

            if (count($url) > 0) {
                $params = $url;
            }
        }
        return  call_user_func_array(array($this->fileAndMethodExists($currentController, $currentAction), $currentAction), $params);
    }

    private function url($url = '/')
    {
        if (isset($_GET['url'])) {
            $url .= rtrim($_GET['url'], '/');
        }

        return filter_var($url, FILTER_SANITIZE_URL);
    }

    private function defaultControllerAndAction($currentController = 'homeController', $currentAction = 'index')
    {
        return [$currentController, $currentAction];
    }

    private function fileAndMethodExists($currentController, $currentAction)
    {
        if (!file_exists('controllers/' . $currentController . '.php') || !method_exists($currentController, $currentAction)) {
            return new notFoundController();
        }

        return new $currentController();
    }
}
