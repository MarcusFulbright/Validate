<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractStringCase;

class LowercaseFirst extends AbstractStringCase
{
    /**
     * Validates that the string begins with lowercase.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, $field)
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        return $this->lcfirst($value) == $value;
    }
}
