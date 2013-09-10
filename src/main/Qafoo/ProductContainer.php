<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Daniel Purrucker
 * Date: 10.09.13
 * Time: 14:17
 */

namespace Qafoo;


class ProductContainer {

    private $products = array();

    /**
     * @param mixed $products
     */
    public function setProducts($products)
    {
        $this->products = $products;
    }

    /**
     * @return mixed
     */
    public function getProducts()
    {
        return $this->products;
    }

    public function addProduct($name, $price) {
        $product = new Product($name, $price);

        $this->products[] = ($product);
    }

    public function getProductByName($name) {
        if(empty($this->products)) {
            throw new \RuntimeException("There are no products given!");
        } else {
            foreach($this->getProducts() as $product) {
                if($product->getName() == $name) {
                    return $product;
                } else {
                    throw new \RuntimeException("There is no product with this name!");
                }
            }
        }
    }
}