<?php

namespace Mbright\Validation\Rule\Sanitize;

class Hex
{
    /**
     * @param $subject
     * @param $field
     * @param int $max
     *
     * @return bool
     */
    public function __invoke($subject, string $field, int $max = null): bool
    {
        $value = $subject->$field;

        if (!is_scalar($value)) {
            return false;
        }

        $value = preg_replace('/[^0-9a-f]/i', '', $value);
        if ($value === '') {
            return false;
        }

        if ($max && strlen($value) > $max) {
            $value = substr($value, 0, $max);
        }

        $subject->$field = $value;

        return true;
    }
}
