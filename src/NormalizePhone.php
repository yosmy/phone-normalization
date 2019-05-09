<?php

namespace Yosmy;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil;

/**
 * @di\service()
 */
class NormalizePhone
{
    /**
     * @param string|null $country
     * @param string|null $prefix
     * @param string      $number
     *
     * @return Phone\Normalization
     *
     * @throws Phone\InvalidNumberException
     */
    public function normalize(
        ?string $country,
        ?string $prefix,
        string $number
    ): Phone\Normalization {
        $phoneNumberUtil = PhoneNumberUtil::getInstance();

        try {
            $phone = $phoneNumberUtil->parse(
                sprintf("%s%s", $prefix, $number),
                $country
            );
        } catch (NumberParseException $e) {
            throw new Phone\InvalidNumberException();
        }

        $country = $phoneNumberUtil->getRegionCodeForNumber($phone);
        $prefix = $phone->getCountryCode();
        $number = $phone->getNationalNumber();

        return new Phone\Normalization(
            $country,
            $prefix,
            $number
        );
    }
}