<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractStringCase;

class Strlen extends AbstractStringCase
{
    /**
     * Sanitizes a string to an exact length by padding or chopping it.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param int $len The string length.
     * @param string $pad_string Pad using this string.
     * @param int $pad_type A `STR_PAD_*` constant.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, $field, $len, $padString = ' ', $padType = STR_PAD_RIGHT)
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }
        if ($this->strlen($value) < $len) {
            $subject->$field = $this->strpad($value, $len, $padString, $padType);
        }
        if ($this->strlen($value) > $len) {
            $subject->$field = $this->substr($value, 0, $len);
        }

        return true;
    }
}
