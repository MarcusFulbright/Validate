<?php

namespace Mbright\Validation\Rule\Sanitize;

class Integer
{
    /**
     * Converts the field to an integer.
     *
     * @param $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if (is_numeric($value)) {
            // we double-cast here to honor scientific notation.
            // (int) 1E5 == 15, but (int) (float) 1E5 == 100000
            $value = (float) $value;
            $subject->$field = (int) $value;

            return true;
        }

        if (!is_string($value)) {
            // cannot sanitize a non-string
            return false;
        }

        // it's a non-numeric string, attempt to extract an integer from it.

        // remove all chars except digit and minus. this removes all + signs; any - sign takes precedence because
        //     0 + -1 = -1
        //     0 - +1 = -1
        // ... at least it seems that way to me now.
        $value = preg_replace('/[^0-9-]/', '', $value);

        // remove all trailing minuses
        $value = rtrim($value, '-');

        // remove all minuses not at the front
        $isNegative = preg_match('/^-/', $value);
        $value = str_replace('-', '', $value);
        if ($isNegative) {
            $value = '-' . $value;
        }

        $subject->$field = (int) $value;

        return true;
    }
}
