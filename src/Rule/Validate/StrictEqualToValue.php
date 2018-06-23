<?php

namespace Mbright\Validation\Rule\Validate;

class StrictEqualToValue implements ValidateRuleInterface
{
    /** @var mixed */
    protected $value;
    
    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * Validates that this value is strictly equal to another value.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the values are equal, false if not equal.
     */
    public function __invoke($subject, string $field): bool
    {
        return $subject->$field === $this->value;
    }
}
