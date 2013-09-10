<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Daniel Purrucker
 * Date: 10.09.13
 * Time: 14:31
 */

namespace Qafoo;


class Product {
    private $name;
    private $price;

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    public function __construct($name, $price)
    {
        $this->setName($name);
        $this->setPrice($price);
    }

}