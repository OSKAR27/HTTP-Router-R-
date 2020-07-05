<?php
namespace HttpRouterUnit\Domain;
use HttpRouter\Domain\Router;

class RouterTest extends \PHPUnit_Framework_TestCase 
{
    protected $router;

    public function setUp()
    {
        $this->router = new Router();

        $this->router->add('/product');
        $this->router->add('/{category}/{product}/');
        $this->router->add('/a_category_name/a_product_name/');
        $this->router->add('/post/{name}');
        $this->router->add('/post/{id}');
        $this->router->add('/post/name=1');
    }

    public function testShouldMatchUriRouter()
    {
        $this->router->setUri('/post/{id}');

        $this->assertTrue($this->router->check());
    }

    public function testShouldMatchFalseUriRouter()
    {
        $this->router->setUri('/nada/1');

        $this->assertFalse($this->router->check());
    }

    public function testShouldMatchParametersUriRouter()
    {
        $this->router->setUri('/post/name=1');

        $this->assertTrue($this->router->check());
    }

    public function testShouldNotMatchUriRouter()
    {
        $this->router->setUri('/name/1');

        $this->assertFalse($this->router->check());
    }
}
