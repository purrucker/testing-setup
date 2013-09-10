<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Daniel Purrucker
 * Date: 10.09.13
 * Time: 14:20
 */

namespace Qafoo;


class ProductContainerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  ProductContainer */
    private $container;

    public function setUp()
    {
        $this->container = new ProductContainer();
    }

    /**
     * @test
     */
    public function  add_product_to_container()
    {
        $this->container->addProduct("A", 30);

        $products = $this->container->getProducts();
        $this->assertTrue(!empty($products));
        $this->assertEquals("A", $products[0]->getName());
        $this->assertEquals(30, $products[0]->getPrice());
    }

    /**
     * @test
     */
    public function get_product_by_name()
    {
        $this->container->addProduct("A", 30);
        $this->container->addProduct("B", 10);

        $product = $this->container->getProductByName("A");
        $this->assertEquals("A", $product->getName());
        $this->assertEquals(30,$product->getPrice());
    }

    /**
     * @test
     */
    public function get_product_on_empty_container()
    {
        $this->setExpectedException("RuntimeException", "There are no products given!");
        $this->container->getProductByName("A");
    }

    /**
     * @test
     */
    public function get_unknown_product_by_name()
    {
        $this->container->addProduct("B", 10);
        $this->setExpectedException("RuntimeException", "There is no product with this name!");
        $this->container->getProductByName("A");
    }
}