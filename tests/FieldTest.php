<?php

namespace Jclyons52\Former;

class FieldTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_input_field()
    {
        $field = new Field(["type" => "text", "labelText" => "Demo Field", "name" => "test" ]);

        $html = $field->toHtml();

        $this->assertContains( "<label for='test'>Demo Field</label>", $html);
        $this->assertContains( "<input type='text' name='test'>", $html);
    }

    /**
     * @test
     */
    public function it_creates_a_check_box()
    {
        $field = new Field(["type" => "checkbox", "labelText" => "Demo Field", "name" => "test" ]);

        $html = $field->toHtml();

        $this->assertContains( "<label for='test'>Demo Field</label>", $html);
        $this->assertContains( "<input type='checkbox' name='test'>", $html);
    }

    /**
     * @test
     */
    public function it_creates_a_text_area()
    {
        $field = new Field(["type" => "textarea", "labelText" => "Demo Field", "name" => "test" ]);

        $html = $field->toHtml();
        $this->assertContains( "<textarea name='test' id='' cols='30' rows='10'></textarea>", $html);
    }
}
