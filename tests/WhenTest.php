<?php

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;
use Humans\When\When;

class WhenTest extends TestCase
{
    function test_return()
    {
        Assert::assertEquals(
            'truthy',
            (new When(true))->return('truthy')->else('falsy')->echo()
        );
    }

    function test_else()
    {
        Assert::assertEquals(
            'falsy',
            (new When(false))->return('truthy')->else('falsy')->echo()
        );
    }

    function test_callable_response()
    {
        Assert::assertEquals(
            'truthy',
            (new When(true))->return(fn () => 'truthy')->echo()
        );
    }

    function test_is()
    {
        Assert::assertEquals(
            'same',
            (new When('hello'))->is('hello')->return('same')->echo()
        );

        Assert::assertEquals(
            null,
            (new When('different'))->is('hello')->return('same')->echo()
        );
    }

    function test_proxy()
    {
        $product = new Product(inventory: 10);
        Assert::assertEquals(
            null,
            (new When($product))->outOfStock()->return('is out of stock')->echo()
        );

        $product = new Product(inventory: -99);
        Assert::assertEquals(
            'is out of stock',
            (new When($product))->outOfStock()->return('is out of stock')->echo()
        );

        $product = new Product(available: true);
        Assert::assertEquals(
            'is available',
            (new When($product))->available->return('is available')->echo()
        );

        $product = new Product(available: false);
        Assert::assertEquals(
            null,
            (new When($product))->available->return('is available')->echo()
        );
    }
}

class Product
{
    public function __construct(
        protected $inventory = 90,
        public $available = true,
    ) { }

    public function outOfStock()
    {
        return $this->inventory <= 0;
    }
}