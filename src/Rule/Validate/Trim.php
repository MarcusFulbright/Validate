<?php

namespace Mbright\Validation\Rule\Validate;

class Trim implements ValidateRuleInterface
{
    /** @var string */
    protected $chars;

    /**
     * @param string $chars The characters to strip.
     */
    public function __construct(string $chars = " \t\n\r\0\x0B")
    {
        $this->chars = $chars;
    }

    /**
     * Validates that a value is already trimmed.
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

        return trim($value, $this->chars) == $value;
    }
}
