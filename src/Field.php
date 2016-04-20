<?php

namespace Jclyons52\Former;

class Field
{
    public function __construct($attributes)
    {
        $this->type = $attributes['type'];
        $this->labelText = $attributes['labelText'];
        $this->name = $attributes['name'];
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
        return "<input type='{$this->type}' name='{$this->name}'>";
    }

}
