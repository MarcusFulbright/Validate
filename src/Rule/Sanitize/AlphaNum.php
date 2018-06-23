<?php

namespace Mbright\Validation\Rule\Sanitize;

class AlphaNum implements SanitizeRuleInterface
{
    /**
     * Strips non-alphanumeric characters from the value.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool Always true.
     */
    public function __invoke($subject, string $field): bool
    {
        $subject->$field = preg_replace('/[^\p{L}\p{Nd}]/u', '', $subject->$field);

        return true;
    }
}
