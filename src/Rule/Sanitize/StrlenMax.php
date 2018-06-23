<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractStringCase;

class StrlenMax extends AbstractStringCase implements SanitizeRuleInterface
{
    /** @var int */
    protected $max;

    /**
     * @param int $max The maximum length.
     */
    public function __construct(int $max)
    {
        $this->max = $max;
    }

    /**
     * Sanitizes a string to a maximum length by chopping it at the right.
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
        if ($this->strlen($value) > $this->max) {
            $subject->$field = $this->substr($value, 0, $this->max);
        }

        return true;
    }
}
