<?php

namespace Mbright\Validation\Rule\Sanitize;

class Alpha implements SanitizeRuleInterface
{
    /**
     * Strips non-alphabetic characters from the value.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool Always true.
     */
    public function __invoke($subject, string $field): bool
    {
        $subject->$field = preg_replace('/[^\p{L}]/u', '', $subject->$field);

        return true;
    }
}
