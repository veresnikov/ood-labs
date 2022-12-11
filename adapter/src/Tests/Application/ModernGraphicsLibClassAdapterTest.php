<?php
declare(strict_types=1);

namespace App\Tests\Application;

use App\Application\ModernGraphicsLibClassAdapter;
use PHPUnit\Framework\TestCase;

class ModernGraphicsLibClassAdapterTest extends TestCase
{
    public function testModernGraphicsLibClassAdapter()
    {
        $startPointX = 42;
        $startPointY = 42;
        $endPointX = $startPointX * 2;
        $endPointY = $startPointY * 2;
        $expected = "<draw>" . PHP_EOL .
            "  <line fromX=\"$startPointX\" fromY=\"$startPointY\" toX=\"$endPointX\" toY=\"$endPointY\" \>" . PHP_EOL .
            "</draw>" . PHP_EOL;

        $tempFile = tmpfile();

        $adapter = new ModernGraphicsLibClassAdapter($tempFile);
        $adapter->BeginDraw();
        $adapter->MoveTo($startPointX, $startPointY);
        $adapter->LineTo($endPointX, $endPointY);
        $adapter->EndDraw();

        fseek($tempFile, 0);
        $result = stream_get_contents($tempFile);
        fclose($tempFile);
        $this->assertSame($expected, $result);
    }

    public function testNoBeginDrawException()
    {
        $endPointX = 42;
        $endPointY = 42;
        $tempFile = tmpfile();
        $adapter = new ModernGraphicsLibClassAdapter($tempFile);
        $this->expectException(\LogicException::class);
        $adapter->LineTo($endPointX, $endPointY);
    }

    public function testEndDrawException()
    {
        $tempFile = tmpfile();
        $adapter = new ModernGraphicsLibClassAdapter($tempFile);
        $this->expectException(\LogicException::class);
        $adapter->EndDraw();
    }

    public function testDoubleBeginDrawException()
    {
        $tempFile = tmpfile();
        $adapter = new ModernGraphicsLibClassAdapter($tempFile);
        $adapter->BeginDraw();
        $this->expectException(\LogicException::class);
        $adapter->BeginDraw();
    }

    public function testDoubleEndDrawException()
    {
        $tempFile = tmpfile();
        $adapter = new ModernGraphicsLibClassAdapter($tempFile);
        $adapter->BeginDraw();
        $adapter->EndDraw();
        $this->expectException(\LogicException::class);
        $adapter->EndDraw();
    }
}
