<?php

namespace Mbright\Validation\Rule\Validate;

class Hex
{
    /**
     * Sanitizes a value to a hex.
     *
     * @param $subject
     * @param $field
     * @param null $max
     *
     * @return bool
     */
    public function __invoke($subject, string $field, int $max = null): bool
    {
        $value = $subject->$field;

        if (!is_scalar($value)) {
            return false;
        }

        $hex = ctype_xdigit($value);
        if (!$hex) {
            return false;
        }

        if ($max && strlen($value) > $max) {
            return false;
        }

        return true;
    }
}
