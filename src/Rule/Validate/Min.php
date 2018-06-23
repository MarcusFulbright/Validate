<?php

namespace Mbright\Validation\Rule\Validate;

class Min implements ValidateRuleInterface
{
    /** @var int */
    protected $min;

    /**
     * @param int $min The minimum valid value.
     */
    public function __construct(int $min)
    {
        $this->min = $min;
    }

    /**
     * Validates that the value is greater than or equal to a minimum.
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

        return $value >= $this->min;
    }
}
