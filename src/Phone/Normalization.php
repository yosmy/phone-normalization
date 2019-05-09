<?php

namespace Yosmy\Phone;

use JsonSerializable;

class Normalization implements JsonSerializable
{
    /**
     * @var string
     */
    private $country;

    /**
     * @var string
     */
    private $prefix;

    /**
     * @var string
     */
    private $number;

    /**
     * @param string $country
     * @param string $prefix
     * @param string $number
     */
    public function __construct(
        string $country,
        string $prefix,
        string $number
    ) {
        $this->country = $country;
        $this->prefix = $prefix;
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return string
     */
    public function getPrefix(): string
    {
        return $this->prefix;
    }

    /**
     * @return string
     */
    public function getNumber(): string
    {
        return $this->number;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'country' => $this->getCountry(),
            'prefix' => $this->getPrefix(),
            'number' => $this->getNumber(),
        ];
    }
}
