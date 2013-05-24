<?php

class View
{
    protected $template;
    protected $variables;

    public function factory($template)
    {
        return new View($template);
    }

    public function __construct($template)
    {
        // Should be some error handling here - what happens
        // if they try to give me the wrong file?
        $themeTemplate = get_stylesheet_directory();
        $dirTemplate = dirname(__FILE__);
        $parentTemplateArray = explode('/', $dirTemplate);
        array_pop($parentTemplateArray);
        $parentTemplate = join('/', $parentTemplateArray);

        $file = '/views/'.$template.'.php';

        if (file_exists($themeTemplate.$file)) {
            $this->template = $themeTemplate.$file;
        } elseif (file_exists($dirTemplate.$file)) {
            $this->template = $dirTemplate.$file;
        } elseif (file_exists($parentTemplate.$file)) {
            $this->template = $parentTemplate.$file;
        } else {
            //Error, throw an exception!
        }
    }

    public function bind($arg1, $arg2 = false)
    {
        if (is_array($arg1)) {
            //This is an array that maps variables to values
            foreach ($arg1 as $variable => $value) {
                $this->variables[$variable] = $value;
            }
        } else {
            $this->variables[$arg1] = $arg2;
        }

        return $this;
    }

    public function render()
    {
        extract($this->variables);
        include($this->template);
    }
}
