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
        $this->template = get_template_directory();
        $this->template .= '/views/'.$template.'.php';

        // Check if it exists, if not throw a file-not-found exception
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
