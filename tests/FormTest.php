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
        $this->assertEquals($dom->querySelector('button')->attr('type'), "submit");
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
     * @test
     */
    public function it_sets_the_default_action_to_post()
    {
        $form = new Form(["action" => "http://example.com/upload"]);

        $html = $form->toHtml();

        $dom = new Document($html);

        $this->assertEquals($dom->querySelector('form')->attr("method"), "POST");
    }

    /**
     * @test
     */
    public function it_adds_enctype_attribute_if_file_is_present()
    {
        $form = new Form(["action" => "http://example.com/upload"]);

        $field = new Field(["type" => "file", "labelText" => "Demo Field", "name" => "test" ]);

        $form->addField($field);

        $html = $form->toHtml();

        $dom = new Document($html);

        $this->assertEquals($dom->querySelector('form')->attr('enctype'), "multipart/form-data");
    }

    /**
     * @test
     */
    public function it_adds_hidden_property_for_non_standard_requests()
    {
        $form = new Form(["action" => "http://example.com/upload", "method" => "PUT"]);

        $html = $form->toHtml();

        $dom = new Document($html);

        $this->assertEquals($dom->querySelector('input[type="hidden"]')->attr('value'), "PUT");
        $this->assertEquals($dom->querySelector('input[type="hidden"]')->attr('name'), "_method");
    }

    /**
     * @test
     */
    public function it_gives_the_form_bootstrap_class_by_default()
    {
        $form = new Form(["action" => "http://example.com/upload"]);

        $html = $form->toHtml();

        $dom = new Document($html);

        $this->assertTrue($dom->querySelector('form')->hasClass('form'));
    }
}