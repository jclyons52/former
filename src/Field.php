<?php

namespace Jclyons52\Former;

class Field
{
    public $type;

    private $labelText;

    private $name;
    
    private $attributes;

    public function __construct($attributes)
    {
        $this->type = $attributes['type'];

        if (array_key_exists("labelText", $attributes)) {
            $this->labelText = $attributes['labelText'];
        }

        $this->name = $attributes['name'];

        unset($attributes['name']);
        unset($attributes['labelText']);

        $this->attributes = $attributes;
    }

    public function toHtml()
    {
        $html = "";
        if ($this->labelText && $this->name) {
            $html .= $this->getLabelHtml();
        }
        $html .= $this->getFieldHtml();

        return $html;
    }

    /**
     * @return string
     */
    private function getLabelHtml()
    {
        return "<label for='{$this->name}'>{$this->labelText}</label>";
    }

    /**
     * @return string
     */
    private function getFieldHtml()
    {
        if ($this->type === "textarea") {
            return "<textarea name='{$this->name}' id='' cols='30' rows='10'></textarea>";
        }

        $attr = "type='{$this->type}' name='{$this->name}'";

        foreach ($this->attributes as $key => $value) {
            $attr .= " {$key}='{$value}' ";
        }

        return  "<input $attr >";
    }
}
