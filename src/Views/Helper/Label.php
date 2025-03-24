<?php

namespace App\Views\Helper;

class Label
{
    private $classList;
    private $value;
    private $inputId;

    public function __construct($value="", $inputId="")
    {
        $this->classList = "form-label";
        $this->value = $value;
        $this->inputId = $inputId;
    }

    public function addClass(...$values)
    {
        foreach($values as $val)
        {
            $this->classList.=" $val";
        }
    }

    public function getContent()
    {
        return "<label for='$this->inputId' class='$this->classList'>$this->value</label>";   
    }

    public function display()
    {
        echo "<label for='$this->inputId' class='$this->classList'>$this->value</label>";
    }
}