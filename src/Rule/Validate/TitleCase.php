<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractStringCase;

class TitleCase extends AbstractStringCase
{
    /**
     * Validates that the string is title case.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (! is_scalar($value)) {
            return false;
        }

        return $this->ucwords($value) == $value;
    }
}
