<?php

class App
{
    /*
        Struktur Routingnya Seperti Berikut
        public/{nama_controller}/{nama_metode}/:parameters
    */

    protected $controller;
    protected $method;
    protected $params;

    public function __construct()
    {
        // Set not found to default
        $this->setDefaultController();

        // Parse URL dulu
        $url = $this->parseURL();
        
        // Set controller yang sesuai dengan url tadi
        $this->setController($url);

        // Set juga methodnya
        $this->setMethod($url);

        // Set juga paramsnya
        $this->setParams($url);

        // Panggil controllernya
        $this->callControllerMethod();
    }

    private function setDefaultController()
    {
        // Default controller when no URL segment is provided
        require_once __DIR__ . '/../controllers/NotFoundController.php';
        $this->controller = new NotFoundController();
        $this->method = 'index';
    }

    private function parseURL()
    {
        // Explode the URL to use for routing
        if (isset($_SERVER['PATH_INFO'])) {
            $url = trim($_SERVER['PATH_INFO'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            return explode('/', $url);
        }
        return [];
    }

    private function setController($url)
    {
        // Cek controllernya ada atau kagak
        $controllerPart = !empty($url[0]) ? $url[0] : null;

        // Construct controllernya yang sesuai
        if (!empty($controllerPart) && file_exists(__DIR__ . '/../controllers/' . $controllerPart . 'Controller.php')) {
            require_once __DIR__ . '/../controllers/' . $controllerPart . 'Controller.php';
            $controllerClass = $controllerPart . 'Controller';
            $this->controller = new $controllerClass();
        }
    }

    private function setMethod($url)
    {
        // Cek metodenya
        $methodPart = !empty($url[1]) ? $url[1] : null;

        // Set metodenya kalau ada
        if (!empty($methodPart) && method_exists($this->controller, $methodPart)) {
            $this->method = $methodPart;
        }
    }

    private function setParams($url)
    {
        // Set paramsnya kalau ada
        unset($url[0], $url[1]);
        $this->params = array_values($url);
    }

    private function callControllerMethod()
    {
        call_user_func_array([$this->controller, $this->method], $this->params);
    }
}
