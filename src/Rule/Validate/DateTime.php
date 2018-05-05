<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractDateTime;

class DateTime extends AbstractDateTime
{
    /**
     * Validate that a value can be represented as a date/time.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        $datetime = $this->newDateTime($value);

        return (bool) $datetime;
    }
}
