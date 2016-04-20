<?php

namespace Jclyons52\Former;

use Jclyons52\PHPQuery\Document;

class FieldTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_input_field()
    {
        $field = new Field(["type" => "text", "labelText" => "Demo Field", "name" => "test" ]);

        $html = $field->toHtml();

        $dom = new Document($html);

        $this->assertEquals($dom->querySelector('label')->text(), "Demo Field");
        $this->assertEquals($dom->querySelector('label')->attr('for'), "test");
        $this->assertEquals($dom->querySelector('input')->attr('type'), "text");
        $this->assertEquals($dom->querySelector('input')->attr('name'), "test");
    }

    /**
     * @test
     */
    public function it_creates_a_check_box()
    {
        $field = new Field(["type" => "checkbox", "labelText" => "Demo Field", "name" => "test" ]);

        $html = $field->toHtml();

        $dom = new Document($html);

        $this->assertEquals($dom->querySelector('input')->parent()->text(), "Demo Field");
        $this->assertEquals($dom->querySelector('input')->parent()->attr('for'), "test");
        $this->assertEquals($dom->querySelector('input')->attr('type'), "checkbox");
        $this->assertEquals($dom->querySelector('input')->attr('name'), "test");

    }

    /**
     * @test
     */
    public function it_creates_a_text_area()
    {
        $field = new Field(["type" => "textarea", "labelText" => "Demo Field", "name" => "test" ]);

        $html = $field->toHtml();
        $dom = new Document($html);

        $this->assertEquals($dom->querySelector('textarea')->attr('name'), "test");
        $this->assertEquals($dom->querySelector('textarea')->attr('cols'), "30");
        $this->assertEquals($dom->querySelector('textarea')->attr('rows'), "10");
    }

    /**
     * @test
     */
    public function it_gives_fields_bootstrap_classes_by_default()
    {
        $field = new Field(["type" => "textarea", "labelText" => "Demo Field", "name" => "test" ]);

        $html = $field->toHtml();
        $dom = new Document($html);

        $this->assertEquals($dom->querySelector('textarea')->parent()->attr('class'), "form-group");
    }
}
