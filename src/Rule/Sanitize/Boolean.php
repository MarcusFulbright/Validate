<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractBooleanCase;

class Boolean extends AbstractBooleanCase
{
    /**
     * Sanitize the value to a boolean, or a pseudo-boolean.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param mixed $true Use this value for `true`.
     * @param mixed $false Use this value for `false`.
     *
     * @return bool Always true.
     */
    public function __invoke($subject, string $field, $true = true, $false = false): bool
    {
        $value = $subject->$field;

        if ($this->isTrue($value)) {
            $subject->$field = $true;

            return true;
        }

        if ($this->isFalse($value)) {
            $subject->$field = $false;

            return true;
        }

        $subject->$field = $value ? $true : $false;

        return true;
    }
}
