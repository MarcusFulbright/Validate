<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractStringCase;

class StrlenMin extends AbstractStringCase implements ValidateRuleInterface
{
    /** @var int */
    protected $min;

    /**
     * @param int $min The value must have at least this many characters.
     */
    public function __construct(int $min)
    {
        $this->min = $min;
    }

    /**
     * Validates that a value is no longer than a certain length.
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

        return $this->strlen($value) >= $this->min;
    }
}
