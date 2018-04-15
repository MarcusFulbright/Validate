<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\RuleInterface;

class Boolean implements RuleInterface
{
    /**
     * Returns bool indicating if the specified field is a boolean.
     *
     * Leverages native `is_bool()` function.
     *
     * @param object $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        return is_bool($subject->$field);
    }
}
