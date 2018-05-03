<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractDateTime;

class DateTime extends AbstractDateTime
{
    /**
     * Sanitize a datetime to a specified format, default "Y-m-d H:i:s".
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param string $format The date format to use.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field, $format = 'Y-m-d H:i:s'): bool
    {
        $value = $subject->$field;
        $datetime = $this->newDateTime($value);
        if (!$datetime) {
            return false;
        }
        $subject->$field = $datetime->format($format);

        return true;
    }
}
