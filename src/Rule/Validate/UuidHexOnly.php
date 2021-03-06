<?php

namespace Mbright\Validation\Rule\Validate;

use Mbright\Validation\Rule\AbstractUuidCase;

class UuidHexOnly extends AbstractUuidCase implements ValidateRuleInterface
{
    /**
     * Validates that the value is a hex-only UUID.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        return $this->isHexOnly($subject->$field);
    }
}
