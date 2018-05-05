<?php

namespace Mbright\Validation\Rule\Validate;

class Callback
{
    /**
     * Validates the value against a callable/callback.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param callable $callable A PHP callable/callback.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field, callable $callable): bool
    {
        return $callable($subject, $field);
    }
}
