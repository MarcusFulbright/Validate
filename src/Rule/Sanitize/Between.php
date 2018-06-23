<?php

namespace Mbright\Validation\Rule\Sanitize;

class Between implements SanitizeRuleInterface
{
    /** @var int */
    protected $min;

    /** @var int */
    protected $max;

    /**
     * @param int $min The minimum value.
     * @param int $max The maximum value.
     */
    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Check that the value is within the given range.
     *
     * If the value is greater than the max, assign it to the max. If it is lower than the min, assign it to the min.
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

        if ($value > $this->max) {
            $subject->$field = $this->max;
        }


        return true;
    }
}
