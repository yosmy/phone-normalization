<?php

namespace Yosmy\Test;

use PHPUnit\Framework\TestCase;
use LogicException;
use Yosmy;

class NormalizePhoneTest extends TestCase
{
    /**
     * @param string|null               $country
     * @param string  |null             $prefix
     * @param string                    $number
     * @param Yosmy\Phone\Normalization $normalization
     *
     * @dataProvider provider
     */
    public function testNormalize(
        ?string $country,
        ?string $prefix,
        string $number,
        Yosmy\Phone\Normalization $normalization
    ) {
        $normalizePhone = new Yosmy\NormalizePhone();

        try {
            $actualNormalization = $normalizePhone->normalize(
                $country,
                $prefix,
                $number
            );
        } catch (Yosmy\Phone\InvalidNumberException $e) {
            throw new LogicException();
        }

        $this->assertEquals(
            $actualNormalization,
            $normalization
        );
    }

    public function provider(): array
    {
        return [
            // Normal
            [
                'US',
                '1',
                '7867861234',
                new Yosmy\Phone\Normalization(
                    'US',
                    '1',
                    '7867861234'
                )
            ],
            // Formal
            [
                'US',
                '1',
                '(786) 786-1234',
                new Yosmy\Phone\Normalization(
                    'US',
                    '1',
                    '7867861234'
                )
            ],

            // Just number
            [
                null,
                null,
                '+1-7867861234',
                new Yosmy\Phone\Normalization(
                    'US',
                    '1',
                    '7867861234'
                )
            ],
        ];
    }

    /**
     * @throws Yosmy\Phone\InvalidNumberException
     */
    public function testNormalizeWithInvalidCharacters(): void
    {
        $normalizePhone = new Yosmy\NormalizePhone();

        $this->expectException(Yosmy\Phone\InvalidNumberException::class);

        try {
            $normalizePhone->normalize(
                'US',
                '1',
                'foo@bar.com'
            );
        } catch (Yosmy\Phone\InvalidNumberException $e) {
            throw $e;
        }
    }
}