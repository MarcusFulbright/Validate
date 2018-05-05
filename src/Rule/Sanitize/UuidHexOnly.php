<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractUuidCase;

class UuidHexOnly extends AbstractUuidCase
{
    /**
     * Forces the value to a hex-only UUID.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = preg_replace('/[^a-f0-9]/i', '', $subject->$field);
        if ($this->isHexOnly($value)) {
            $subject->$field = $value;

            return true;
        }

        return false;
    }
}
