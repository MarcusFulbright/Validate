<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractStringCase;

class Strlen extends AbstractStringCase implements ValidateRuleInterface
{
    /** @var int */
    protected $len;

    /**
     * @param int $len The minimum valid length.
     */
    public function __construct(int $len)
    {
        $this->len = $len;
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

        return $this->strlen($value) === $this->len;
    }
}
