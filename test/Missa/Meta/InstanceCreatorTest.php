<?php

namespace Missa\Meta;

class InstanceCreatorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @return void
     */
    public function foo()
    {
        $this->assertInstanceOf('stdClass', InstanceCreator::create('stdClass'));

        $class = __NAMESPACE__ . '\\Foo';
        $foo = InstanceCreator::create($class);
        $this->assertSame('hello', $foo->actual);
        $this->assertInstanceOf($class, $foo);
    }
}

class Foo
{
    /**
     * @Inject
     * @var Bar
     */
    protected $bar;

    public $actual;

    function __construct()
    {
        $this->actual = $this->bar->hello();
    }
}

class Bar
{
    function hello()
    {
        return "hello";
    }
}