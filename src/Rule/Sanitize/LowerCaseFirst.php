<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractStringCase;

class LowerCaseFirst extends AbstractStringCase implements SanitizeRuleInterface
{
    /**
     * Sanitizes a string to begin with lowercase.
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
        $subject->$field = $this->lcfirst($value);

        return true;
    }
}
