<?php
namespace core;
use core\FH;

class View 
{
    protected $_head, $_body, $_title = SITE_TITLE, $_output_buffer, $_layout = DEFAULT_LAYOUT;

    public function __construct(){}

    public function render($view_name)
    {
        $view_string = $view_name;

        if(file_exists(ROOT.SP.'app'.SP.'views'.SP. $view_string . '.php'))
        {
            include(ROOT.SP.'app'.SP.'views'.SP. $view_string.'.php');
            include((ROOT.SP.'app'.SP.'views'.SP.'layouts'.SP.$this->_layout.'.php'));
        }else
        {
            die('This view \"' . $view_name . '\" does not exists.');
        }
    }

    public function content($type) 
    {
        if($type == 'head')
        {
            return $this->_head;
        }elseif($type == 'body')
        {
            return $this->_body;
        }
        return false;
    }

    public function start($type)
    {
        $this->_output_buffer = $type;
        ob_start();
    }

    public function end()
    {
        if ($this->_output_buffer == 'head')
        {
            $this->_head = ob_get_clean();
        }elseif($this->_output_buffer == 'body')
        {
            $this->_body = ob_get_clean();
        }else
        {
            die('You must first run start()');
        }
    }

    public function get_title()
    {
        return $this->_title;
    }

    public function set_title($title)
    {
        $this->_title = $title;
    }

    public function set_layout($path)
    {
        $this->_layout = $path;
    }

    public function insert($path)
    {
        include ROOT.SP.'app'.SP.'views'.SP. $path.'.php';
    }

    public function partial($group, $partial)
    {
        include ROOT.SP.'app'.SP.'views'.SP.$group.SP.'partials'.SP.$partial.'.php' ;
    }
}