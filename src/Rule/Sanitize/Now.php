<?php

namespace Mbright\Validation\Rule\Sanitize;

class Now
{
    /**
     * Force the value to the current time, default format "Y-m-d H:i:s".
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param mixed $format The date format.
     *
     * @return bool Always true.
     */
    public function __invoke($subject, string $field, string $format = 'Y-m-d H:i:s'): bool
    {
        $subject->$field = date($format);

        return true;
    }
}
