<?php

namespace Mbright\Validation\Rule\Sanitize;

class Min implements SanitizeRuleInterface
{
    /** @var int */
    protected $min;

    public function __construct(int $min)
    {
        $this->min = $min;
    }

    /**
     * Sanitizes to minimum value if value is less than min.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }
        if ($value < $this->min) {
            $subject->$field = $this->min;
        }

        return true;
    }
}
