<?php

namespace Mbright\Validation\Rule\Validate;

class AbstractIntegerCase
{
    /**
     * Indicates if the given value is an integer.
     *
     * @param $value
     *
     * @return bool
     */
    protected function isInteger($value): bool
    {
        return is_int($value);
    }

    /**
     * Indicates if the given value is numeric.
     *
     * @param $value
     *
     * @return bool
     */
    protected function isNumeric($value): bool
    {
        return is_numeric($value) && $value == (int) $value;
    }

    /**
     * Indicates if the given value is an integer or numeric.
     *
     * @param $value
     *
     * @return bool
     */
    protected function isIntOrNumeric($value): bool
    {
        return $this->isInteger($value) || $this->isNumeric($value);
    }
}
