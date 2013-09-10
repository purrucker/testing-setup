<?php

namespace Qafoo;

class CheckoutTest extends \PHPUnit_Framework_TestCase
{
    /** @var  Checkout */
    private $checkout;

    private $displayMock;

    private $productContainerMock;

    public function setUp()
    {
        $builder = $this->getMockBuilder('Qafoo\\Display');
        $builder->disableOriginalConstructor();

        $this->displayMock = $builder->getMock();

        $builder = $this->getMockBuilder('Qafoo\\ProductContainer');
        $builder->disableOriginalConstructor();

        $this->productContainerMock = $builder->getMock();

        $this->checkout = new Checkout(
            $this->displayMock,
            $this->productContainerMock
        );
    }

    /**
     * @test
     */
    public function testCheckoutCalculatesForSingleProduct()
    {
        $this->productContainerMock->expects($this->any())
            ->method('getProductByName')
            ->will(
                $this->returnValue(new Product("A",30))
            );
        $this->checkout->registerProduct("A");

        $this->assertEquals(
            30,
            $this->checkout->calculateSum()
        );
    }

    /**
     * @test
     */
    public function with_two_products_checkout_calculates_correct()
    {
        $this->productContainerMock->expects($this->any())
            ->method('getProductByName')
            ->will(
                $this->returnCallback(
                    function ($name) {
                        if($name == "A") {
                            return new Product("A", 30);
                        }
                        if($name == "B") {
                            return new Product("B", 10);
                        }
                    }
                )
            );

        $this->checkout->registerProduct("A");
        $this->checkout->registerProduct("B");

        $this->assertEquals(
            40,
            $this->checkout->calculateSum()
        );
    }

    /**
     * @test
     */
    public function displays_current_sum()
    {
        $this->displayMock->expects($this->once())
            ->method('renderText')
            ->with(
                $this->equalTo(30)
            );
        $this->productContainerMock->expects($this->any())
            ->method('getProductByName')
            ->will(
                $this->returnValue(new Product("A",30))
            );

        $this->checkout->registerProduct("A");

    }

    /**
     * @test
     */
    public function register_non_existent_product()
    {
        $this->productContainerMock->expects($this->any())
            ->method('getProductByName')
            ->will(
                $this->throwException(new \RuntimeException())
            );
        $this->setExpectedException("RuntimeException", "Could not register product!");
        $this->checkout->registerProduct("A");
    }
}
