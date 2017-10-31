<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest1 extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $ckass=get_class(\Illuminate\Support\Facades\Storage::disk("local")) ;
        
        echo $ckass;
        $this->assertTrue(true);
    }
}
