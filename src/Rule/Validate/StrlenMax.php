<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractStringCase;

class StrlenMax extends AbstractStringCase implements ValidateRuleInterface
{
    /** @var int */
    protected $max;

    /**
     * @param int $max The value must have no more than this many characters.
     */
    public function __construct(int $max)
    {
        $this->max = $max;
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

        return $this->strlen($value) <= $this->max;
    }
}
