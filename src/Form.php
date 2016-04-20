<?php

namespace Jclyons52\Former;

class Form
{
    private $fields = [];

    public function __construct($attributes = [])
    {
        $this->action = $attributes['action'];
    }
    
    public function toHtml()
    {
        $html = "<form action='{$this->action}'>";
        
        foreach ($this->fields as $field) {
            $html .= $field->toHtml();
        }

        $html .= "</form>";
        
        return $html;
    }

    public function addField(Field $field)
    {
        $this->fields[] = $field;
    }
}

