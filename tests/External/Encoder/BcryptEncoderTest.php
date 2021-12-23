<?php

declare(strict_types=1);

namespace Test\External\Encoder;

use PHPUnit\Framework\TestCase;
use App\External\Encoder\BcryptEncoder;

class BcryptEncoderTest extends TestCase
{
    public function testCanCorrectlyEncodeAndDecodeAString(): void
    {
        $encoder = new BcryptEncoder();

        $plainText = "abcABC123";

        $hash = $encoder->hash($plainText);

        $this->assertEquals(true, $encoder->verify($plainText, $hash));
    }
}
