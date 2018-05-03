<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractUuidCase;

class Uuid extends AbstractUuidCase
{
    /**
     * Forces the value to a canonical UUID.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, $field)
    {
        $value = $subject->$field;
        if ($this->isCanonical($value)) {
            return true;
        }

        // force to hex only
        $value = preg_replace('/[^a-f0-9]/i', '', $subject->$field);
        if (!$this->isHexOnly($value)) {
            // not hex-only, cannot sanitize
            return false;
        }

        // add the dashes
        $subject->$field = substr($value, 0, 8) . '-'
            . substr($value, 8, 4) . '-'
            . substr($value, 12, 4) . '-'
            . substr($value, 16, 4) . '-'
            . substr($value, 20);

        return true;
    }
}
