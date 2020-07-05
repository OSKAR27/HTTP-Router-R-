<?php
namespace HttpRouterUnit\Domain;
use HttpRouter\Domain\ExtractVariable;

class ExtractVariableTest extends \PHPUnit_Framework_TestCase 
{
    protected $variables;

    public function setUp()
    {
        $this->variables = ExtractVariable::variable_extractor("/a_category_name/a_product_name/", "/{category}/{product}/");
    }

    public function testAddUriNotEmptyRoute()
    {
        $this->assertNotEmpty($this->variables);
    }

    public function testShouldCountParameter()
    {

        $this->assertEquals(2, count($this->variables));
    }

    public function testShouldContainsParameter()
    {
        $this->assertArrayHasKey('category', $this->variables);
    }

    public function testNotShouldContainsParameter()
    {
        $this->assertArrayNotHasKey('name', $this->variables);
    }
}