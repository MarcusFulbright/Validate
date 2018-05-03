<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractStringCase;

class StrBetween extends AbstractStringCase
{
    /**
     * Sanitizes a string to a length range by padding or chopping it.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param int $min The minimum length.
     * @param int $max The maximum length.
     * @param string $pad_string Pad using this string.
     * @param int $pad_type A `STR_PAD_*` constant.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, $field, $min, $max, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }
        if ($this->strlen($value) < $min) {
            $subject->$field = $this->strpad($value, $min, $padString, $padType);
        }
        if ($this->strlen($value) > $max) {
            $subject->$field = $this->substr($value, 0, $max);
        }

        return true;
    }
}
