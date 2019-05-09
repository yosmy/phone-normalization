<?php

namespace Yosmy\Phone;

use Exception;
use JsonSerializable;

class InvalidNumberException extends Exception implements JsonSerializable
{
    /**
     * {@inheritDoc}
     */
    public function jsonSerialize(): array
    {
        return [
            'class' => self::class
        ];
    }
}