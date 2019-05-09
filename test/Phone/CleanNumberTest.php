<?php

namespace Yosmy\Test\Phone;

use PHPUnit\Framework\TestCase;
use Yosmy;

class CleanNumberTest extends TestCase
{
    /**
     * @param string $number
     * @param string $cleaned
     *
     * @dataProvider provider
     */
    public function testNormalize(
        string $number,
        string $cleaned
    ): void
    {
        $cleanNumber = new Yosmy\Phone\CleanNumber();

        $actualCleaned = $cleanNumber->clean(
            $number
        );

        $this->assertEquals(
            $cleaned,
            $actualCleaned
        );
    }

    public function provider(): array
    {
        return [
            [
                ' (786) 786 1234 ',
                '7867861234'
            ],
        ];
    }
}