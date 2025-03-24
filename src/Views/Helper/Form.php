<?php
namespace App\Views\Helper;

class Form 
{
    private $method;
    private $action;
    private $enctype;
    private $content;
    private $opened;

    public function __construct($action="", $method="post", $enctype="")
    {
        $this->method = $method;
        $this->action = $action;
        $this->enctype = $enctype;
        $this->content = "";
        $this->opened = false;
    }

    public function formOpen()
    {
        if(!$this->opened)
        {
            $this->content.="<form method='$this->method' action='$this->action' enctype='$this->enctype'>";
            $this->opened = true;
        }
        else
        {
            //I should throw an exception...
        }
    }

    public function formClose()
    {
        if ($this->opened) 
        {
            $this->content.="</form>";
            $this->opened = false;
        }
    }

    public function addInput(Object ...$inputs)
    {

        if ($this->opened) 
        {
            foreach($inputs as $input)
            {
                $this->content.="\n".$input->getContent();
            }
        }

        else
        {
            //I shoudl throw an Exception...
        }

    }

    public function display()
    {
        echo $this->content;
    }
}