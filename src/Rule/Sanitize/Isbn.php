<?php

namespace Mbright\Validation\Rule\Sanitize;

class Isbn implements SanitizeRuleInterface
{
    /**
     * Forces the value to an ISBN.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = preg_replace('/(?:(?!([0-9|X$])).)*/', '', $subject->$field);
        if (preg_match('/^[0-9]{10,13}$|^[0-9]{9}X$/', $value) == 1) {
            $subject->$field = $value;

            return true;
        }

        return false;
    }
}
