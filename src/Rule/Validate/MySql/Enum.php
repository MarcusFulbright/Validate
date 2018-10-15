<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\InValues;

/**
 * Validates that data can be inserted into one of the following column types:
 * - Enum
 */
class Enum extends InValues
{
    /**
     * @param array $array Array of valid values.
     */
    public function __construct(array $array)
    {
        $arrayCount = count($array);

        if ($arrayCount <= 0 || $arrayCount > 65535) {
            throw new \InvalidArgumentException('Enum must have 1 value and no more than 65,535 values');
        }

        parent::__construct($array);
    }
}
