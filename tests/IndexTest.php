<?php
namespace tests;
class IndexTest extends TestCase
{

    public function testSomethingIsTrue()
    {
        $this->assertTrue(true);
    }
    public function testTest()
    {
        $this->visit('/admin/index/test')->see('Hello world!');
    }

}
