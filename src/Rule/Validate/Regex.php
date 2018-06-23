<?php

namespace Mbright\Validation\Rule\Validate;

class Regex implements ValidateRuleInterface
{
    /** @var string */
    protected $expr;

    /**
     * @param string $expr The regular expression to validate against.
     */
    public function __construct(string $expr)
    {
        $this->expr = $expr;
    }

    /**
     * Validates the value against a regular expression.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value matches the expression, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        return (bool) preg_match($this->expr, $value);
    }
}
