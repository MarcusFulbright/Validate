<?php

namespace Mbright\Validation\Rule\Sanitize;

class Callback implements SanitizeRuleInterface
{
    /** @var callable */
    protected $callback;

    /**
     * @param callable $callback Function to use.
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * Sanitizes a value using a callable/callback.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param callable $callable A callable/callback.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        return ($this->callback)($subject, $field);
    }
}
