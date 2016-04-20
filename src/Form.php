<?php

namespace Jclyons52\Former;

class Form
{
    private $fields = [];

    private $method = "POST";

    private $hasFile = false;

    public function __construct($attributes = [])
    {
        $this->action = $attributes['action'];

        if (array_key_exists('method', $attributes)) {
            $this->method = $attributes['method'];
        }
    }
    
    public function toHtml()
    {
        $enctype = $this->hasFile ? "enctype='multipart/form-data'" : '';

        $html = "<form action='{$this->action}' method='{$this->method}' {$enctype} class='form'>";

        if (strtoupper($this->method) !== "POST") {
            $this->spoofHttpMethod($this->method);
        }
        
        foreach ($this->fields as $field) {
            $html .= $field->toHtml();
        }

        $html .= "<button type='submit' class='btn btn-default'>Submit</button></form>";
        
        return $html;
    }

    public function addField(Field $field)
    {
        if ($field->type === "file") {
            $this->hasFile = true;
        }
        $this->fields[] = $field;
    }

    /**
     * @return Field
     */
    private function spoofHttpMethod($method)
    {
        $field = new Field(["type" => "hidden", "name" => "_method", "value" => $method]);
        $this->addField($field);

        return $field;
    }
}
