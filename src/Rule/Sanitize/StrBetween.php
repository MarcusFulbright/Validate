<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractStringCase;

class StrBetween extends AbstractStringCase implements SanitizeRuleInterface
{
    /** @var int */
    protected $min;

    /** @var int */
    protected $max;

    /** @var string */
    protected $padString;

    /** @var int */
    protected $padType;

    /**
     * @param int $min The minimum length.
     * @param int $max The maximum length.
     * @param string $pad_string Pad using this string.
     * @param int $pad_type A `STR_PAD_*` constant.
     *
     */
    public function __construct(int $min, int $max, string $padString = ' ', int $padType = STR_PAD_RIGHT)
    {
        $this->min = $min;
        $this->max = $max;
        $this->padString = $padString;
        $this->padType = $padType;
    }

    /**
     * Sanitizes a string to a length range by padding or chopping it.
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
        if ($this->strlen($value) < $this->min) {
            $subject->$field = $this->strpad($value, $this->min, $this->padString, $this->padType);
        }
        if ($this->strlen($value) > $this->max) {
            $subject->$field = $this->substr($value, 0, $this->max);
        }

        return true;
    }
}
