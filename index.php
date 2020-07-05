<?php

require_once __DIR__ . '/vendor/autoload.php';
use HttpRouter\Domain\Router;
use HttpRouter\Domain\ExtractVariable;

$router = new Router();

$router->add('/product/{product}');

$router->add('/productos/:name');

$router->add('/{category}/{product}/');

$router->add('/a_category_name/a_name_name/');

$router->add('/a_category_name/a_product_name/');

$router->setUri('/product/1');

$router->check();

ExtractVariable::variable_extractor("/a_category_name/a_product_name/", "/{category}/{product}/");

