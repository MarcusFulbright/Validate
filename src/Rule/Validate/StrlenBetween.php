<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractStringCase;

class StrlenBetween extends AbstractStringCase implements ValidateRuleInterface
{
    /** @var int */
    protected $min;
    
    /** @var int */
    protected $max;

    /**
     * @param int $min The minimum valid length.
     * @param int $max The maximum valid length.
     */
    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Validates that the length of the value is within a given range.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }
        $len = $this->strlen($value);

        return ($len >= $this->min && $len <= $this->max);
    }
}
