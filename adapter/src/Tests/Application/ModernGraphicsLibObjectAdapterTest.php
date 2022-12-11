<?php
declare(strict_types=1);

namespace App\Tests\Application;

use App\Application\ModernGraphicsLibObjectAdapter;
use App\ModernGraphicsLib\ModernGraphicsRenderer;
use PHPUnit\Framework\TestCase;

class ModernGraphicsLibObjectAdapterTest extends TestCase
{
    public function testModernGraphicsLibObjectAdapter()
    {
        $startPointX = 42;
        $startPointY = 42;
        $endPointX = $startPointX * 2;
        $endPointY = $startPointY * 2;
        $color = 0xFFF111;
        $expected = "<draw>" . PHP_EOL .
            "  <line fromX=\"$startPointX\" fromY=\"$startPointY\" toX=\"$endPointX\" toY=\"$endPointY\">" . PHP_EOL .
            "    <color r=\"1\" g=\"0.95\" b=\"0.07\" a=\"1\" />" . PHP_EOL .
            "  </line>" . PHP_EOL .
            "</draw>" . PHP_EOL;

        $tempFile = tmpfile();

        $modernRenderer = new ModernGraphicsRenderer($tempFile);
        $adapter = new ModernGraphicsLibObjectAdapter($modernRenderer);
        $modernRenderer->BeginDraw();
        $adapter->SetColor($color);
        $adapter->MoveTo($startPointX, $startPointY);
        $adapter->LineTo($endPointX, $endPointY);
        $modernRenderer->EndDraw();

        fseek($tempFile, 0);
        $result = stream_get_contents($tempFile);
        fclose($tempFile);
        $this->assertSame($expected, $result);
    }
}
