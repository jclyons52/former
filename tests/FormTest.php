<?php

namespace Jclyons52\Former;

class FormTest extends TestCase
{
    /**
     * @test
     */
    public function it_renders_the_html_for_a_form()
    {
        $form = new Form(["action" => "http://example.com/upload"]);

        $html = $form->toHtml();

        $this->assertContains("<form action='http://example.com/upload'></form>", $html);
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

        $this->assertContains("<form action='http://example.com/upload'>", $html);
        $this->assertContains( "<label for='test'>Demo Field</label>", $html);
        $this->assertContains( "<input type='text' name='test'>", $html);
    }

    /**
     * 
     */
    public function it_sets_the_default_action_to_post()
    {

    }
}