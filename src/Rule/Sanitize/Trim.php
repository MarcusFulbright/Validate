<?php

namespace Mbright\Validation\Rule\Sanitize;

class Trim implements SanitizeRuleInterface
{
    /** @var string */
    protected $chars;

    /**
     * @param string $chars The characters to trim.
     */
    public function __construct(string $chars = " \t\n\r\0\x0B")
    {
        $this->chars = $chars;
    }

    /**
     * Sanitizes a value to a string using trim().
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (is_scalar($value) || $value === null) {
            $subject->$field = trim($value, $this->chars);

            return true;
        }

        return false;
    }
}
