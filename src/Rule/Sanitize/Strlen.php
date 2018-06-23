<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractStringCase;

class Strlen extends AbstractStringCase implements SanitizeRuleInterface
{
    /** @var int */
    protected $len;

    /** @var string */
    protected $padString;

    /** @var int */
    protected $padType;

    /**
     * @param int $len The string length.
     * @param string $pad_string Pad using this string.
     * @param int $pad_type A `STR_PAD_*` constant.
     */
    public function __construct(int $len, string $padString = ' ', int $padType = STR_PAD_RIGHT)
    {
        $this->len = $len;
        $this->padString = $padString;
        $this->padType = $padType;
    }

    /**
     * Sanitizes a string to an exact length by padding or chopping it.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }
        if ($this->strlen($value) < $this->len) {
            $subject->$field = $this->strpad($value, $this->len, $this->padString, $this->padType);
        }
        if ($this->strlen($value) > $this->len) {
            $subject->$field = $this->substr($value, 0, $this->len);
        }

        return true;
    }
}
