<?php

/**
 * Обработка запроса и переключение класса контроллера
 *
 *
 * @var $routes
 *
 * @param run
 * @param getURI()
 *
 */

class Router
{
    private $routes;

    public function __construct()
    {
        $routerPath = ROOT. '/config/routes.php';
        $this -> routes = include($routerPath);
    }

    /**
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
           return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run()
    {
        // Получаем строку запроса
        $uri = $this -> getURI();

        // Проверяем наличие такого запроса в routes.php
        foreach ($this->routes as $uriPattern => $path)
        {
            // сравнение $uriPattern и $uri
            if (preg_match("~$uriPattern~", $uri)){

                // Получаем внутрений путь из внешнего согласно правилу.

                $internalRoute = preg_replace("~$uriPattern~", $path ,$uri);

                // отпределяем какой контроллер и action обрабатывает запрос
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments).'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action'. ucfirst(array_shift($segments));

                $parameters = $segments;

                echo "<pre>";

                // Переключаем файл класса-контроллера
                $controllerFile = ROOT . '/controllers/' .
                    $controllerName . '.php';
                if (file_exists($controllerFile)){
                    require_once ($controllerFile);
                }

                // Создаем объект, вызываем метод ( т.е. action )
                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if($result != null){
                    break;
                }
            }
        }
    }
}