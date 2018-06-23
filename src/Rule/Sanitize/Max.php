<?php

namespace Mbright\Validation\Rule\Sanitize;

class Max implements SanitizeRuleInterface
{
    /** @var int */
    protected $max;

    /**
     * @param int $max
     */
    public function __construct(int $max)
    {
        $this->max = $max;
    }

    /**
     * Sanitizes to maximum value if value is greater than max.
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
        if ($value > $this->max) {
            $subject->$field = $this->max;
        }

        return true;
    }
}
