<?php

namespace Yosmy\Phone;

/**
 * @di\service()
 */
class CleanNumber
{
    /**
     * @param string $number
     *
     * @return string
     */
    public function clean(
        string $number
    ): string {
        return preg_replace('/[^0-9]/', '', $number);
    }
}