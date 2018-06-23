<?php

namespace Mbright\Validation\Rule\Sanitize;

class Value implements SanitizeRuleInterface
{
    /** @var mixed */
    protected $otherValue;

    /**
     * @param mixed $otherValue The value to set.
     */
    public function __construct($otherValue)
    {
        $this->otherValue = $otherValue;
    }

    /**
     * Modifies the field value to match another value.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool Always true.
     */
    public function __invoke($subject, string $field): bool
    {
        $subject->$field = $this->otherValue;

        return true;
    }
}
