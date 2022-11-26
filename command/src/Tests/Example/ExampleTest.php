<?php
declare(strict_types=1);

namespace App\Tests\Example;

use App\Example\Example;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testHelloWorld()
    {
        $this->assertSame("Hello world", Example::HelloWorld());
    }
}
