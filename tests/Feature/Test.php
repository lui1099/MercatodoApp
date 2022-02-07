<?php

namespace Tests\Feature;

use ProductMgmtTest;
//use PHPUnit\Framework\TestCase;
use Tests\TestCase;

class Test extends TestCase
{
    public function testItVisitsProductsIndex()
    {
        $response = $this->get(route('products.index'));

        $response->assertOK();

    }

}
