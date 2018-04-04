<?php

namespace Nashphp\Validation\Rule\Sanitize;

use Nashphp\Validation\Rule\RuleInterface;

class Integer implements RuleInterface
{
    /**
     * Converts the field to an integer.
     *
     * Uses the native `(int)` type cast.
     *
     * @param $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $subject->$field = (int) $subject->$field;

        return true;
    }
}
