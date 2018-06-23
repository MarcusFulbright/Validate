<?php

namespace Mbright\Validation\Rule\Validate;

class Max implements ValidateRuleInterface
{
    /** @var int */
    protected $max;

    /**
     * @param int $max The maximum valid value.
     */
    public function __construct(int $max)
    {
        $this->max = $max;
    }

    /**
     * Validates that the value is less than than or equal to a maximum.
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

        return $value <= $this->max;
    }
}
