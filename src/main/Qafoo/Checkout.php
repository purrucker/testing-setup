<?php

namespace Qafoo;

class Checkout
{
    private $productContainer;
    private $sum;
    private $display;

    public function __construct(Display $display, ProductContainer $container)
    {
        $this->productContainer = $container;
        $this->display = $display;
    }

    public function registerProduct($productName)
    {
        try {
            $product = $this->productContainer->getProductByName($productName);
            $this->display->renderText($product->getPrice());
            $this->sum += $product->getPrice();
        } catch(\RuntimeException $e) {
            throw new \RuntimeException("Could not register product!");
        }
    }

    public function calculateSum()
    {
         return $this->sum;
    }
}
