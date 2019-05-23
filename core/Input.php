<?php
namespace core;
use core\FH;
use core\Router;
class Input
{

    public function is_post()
    {
        return $this->get_request_method() == 'POST';
    }

    public function is_put()
    {
        return $this->get_request_method() == 'PUT';
    }

    public function is_get()
    {
        return $this->get_request_method() == 'GET';
    }


    public function get_request_method()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public function exists($input)
    {
        return isset($_REQUEST[$input])? true : false;
    }


    public function get($input=false)
    {
        if(!$input)
        {
            //return entire request array and sanatize
            $data = [];
            foreach($_REQUEST as $field => $value)
            {
                $data[$field] = FH::sanatize($value);
            }
            return $data;
        }
        return FH::sanatize($_REQUEST[$input]);
    }

    public function csrf_check()
    {
        if(!FH::check_token($this->get('csrf_token'))) Router::redirect('restricted/invalid_token');
        return true;
    }
}