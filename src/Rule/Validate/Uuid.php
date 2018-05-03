<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractUuidCase;

class Uuid extends AbstractUuidCase
{
    /**
     * Validates that the value is a canonical human-readable UUID.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, $field)
    {
        return $this->isCanonical($subject->$field);
    }
}
