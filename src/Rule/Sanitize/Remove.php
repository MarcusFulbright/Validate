<?php

namespace Mbright\Validation\Rule\Sanitize;

class Remove implements SanitizeRuleInterface
{
    /**
     * Removes the field from the subject with unset().
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool Always true.
     */
    public function __invoke($subject, string $field): bool
    {
        unset($subject->$field);

        return true;
    }
}
