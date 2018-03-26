<?php

namespace Nashphp\Validation\Rule\Sanitize;

use Nashphp\Validation\Rule\RuleInterface;

class ToBool implements RuleInterface
{
    /**
     * TypeCasts the given field to a boolean.
     *
     * Ues internal (bool) type cast.
     *
     * @param object $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke(object $subject, string $field): bool
    {
        $subject->$field = (bool) $subject->$field;
    }
}
