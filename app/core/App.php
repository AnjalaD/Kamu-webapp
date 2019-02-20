<?php

class App
{

    protected $controller = 'page';

    protected $method = 'index';

    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if(file_exists('../app/controllers/' . $url[0] . '.php'))
        {
            $this->controller = $url[0];
            unset($url[0]);

        }
        //set controller
        require_once '../app/controllers/' . $this->controller . '.php';

        //make new controller object
        $this->controller = new $this->controller;

        if(isset($url[1]))
        {
            if(method_exists($this->controller, $url[1]))
            {
                $this->method = $url[1];
                unset($url[1]);
                
            }

        }
        //put params into new array
        $this->params = $url ? array_values($url) : [] ;
        
        //call method requested 
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    // remove unwanted / s from url
    public function parseUrl()
    {
        if(isset($_GET['url'])) 
        {
            return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
?>