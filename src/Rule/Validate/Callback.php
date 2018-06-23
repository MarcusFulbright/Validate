<?php

namespace Mbright\Validation\Rule\Validate;

class Callback implements ValidateRuleInterface
{
    /** @var callable */
    protected $callable;

    /**
     * @param callable $callable A PHP callable/callback.
     */
    public function __construct(callable $callable)
    {
        $this->callable = $callable;
    }

    /**
     * Validates the value against a callable/callback.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        return ($this->callable)($subject, $field);
    }
}
