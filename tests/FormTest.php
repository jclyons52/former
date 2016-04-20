<?php

namespace Jclyons52\Former;

use Jclyons52\PHPQuery\Document;

class FormTest extends TestCase
{
    /**
     * @test
     */
    public function it_renders_the_html_for_a_form()
    {
        $form = new Form(["action" => "http://example.com/upload"]);

        $html = $form->toHtml();

        $dom = new Document($html);

        $this->assertEquals($dom->querySelector('form')->attr('action'), "http://example.com/upload");
    }

    /**
     * @test
     */
    public function it_adds_fields_to_form()
    {
        $form = new Form(["action" => "http://example.com/upload"]);

        $field = new Field(["type" => "text", "labelText" => "Demo Field", "name" => "test" ]);

        $form->addField($field);

        $html = $form->toHtml();

        $dom = new Document($html);

        $this->assertEquals($dom->querySelector('form')->attr('action'), "http://example.com/upload");
        $this->assertEquals($dom->querySelector('label')->text(), "Demo Field");
        $this->assertEquals($dom->querySelector('label')->attr('for'), "test");
        $this->assertEquals($dom->querySelector('input')->attr('type'), "text");
        $this->assertEquals($dom->querySelector('input')->attr('name'), "test");
    }

    /**
     *
     */
    public function it_sets_the_default_action_to_post()
    {

    }
}