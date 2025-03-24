<?php

namespace App\Views\Helper;

use App\Views\Helper\Label; 

require_once 'Label.php';

class Input
{
    private $name;
    private $classList;
    private $type;
    private $value;
    private $id;
    private $withLabel;
    private $isInvalid;

    public function __construct($type="text", $name='',  $value="", $withLabel=false, $id='', $isInvalid=false)
    {
        $this->name = $name;
        $this->type = $type;
        $this->value= $value;
        $this->id = $id;
        $this->withLabel = $withLabel;
        $this->isInvalid = $isInvalid;

        if($this->isInvalid)
        {
            $this->classList = "form-control is-invalid";
        }

        else
        {
            $this->classList = "form-control";   
        }
    }

    public function addClass(...$values)
    {
        foreach($values as $val)
        {
            $this->classList.=" $val";
        }
    }

    public function display()
    {
        if($this->withLabel)
        {
            $label = new Label($this->name, $this->name);
           
            echo "$label"."\n<input type='$this->type' name='$this->name' class='$this->classList' value='$this->value'>";
        }

        else
        {
            echo "<input type='$this->type' name='$this->name' class='$this->classList' value='$this->value'>";
        }
    }


    public function getContent()
    {
        if($this->withLabel)
        {
            $label = (new Label($this->name, $this->name))->getContent();
            
            return "$label\n"."<input type='$this->type' name='$this->name' class='$this->classList' value='$this->value'>";
        }

        else
        {
            return "<input type='$this->type' name='$this->name' class='$this->classList' value='$this->value'>";
        }   
    }

    public function setValValue($value)
    {
        if($value)
        {
            $this->value = $value;
        }
    }

    public function removeClass($className)
    {

        $array =  explode(" ", $this->classList);
        $key = array_search($className, $array);

        if($key)
        {
            array_splice($array, (int)$key, 1);
            $this->classList = implode(' ', $array);    
        }

    }
}
