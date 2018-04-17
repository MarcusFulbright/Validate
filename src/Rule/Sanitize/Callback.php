<?php

namespace Mbright\Validation\Rule\Sanitize;

class Callback
{
    /**
     * Sanitizes a value using a callable/callback.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param callable $callable A callable/callback.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field, callable $callable): bool
    {
        return $callable($subject, $field);
    }
}
