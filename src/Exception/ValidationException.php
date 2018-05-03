<?php

namespace Mbright\Validation\Exception;

class ValidationException extends \Exception
{
    /**
     * Returns an exception for a rule missing from a locator.
     *
     * @param $rule
     *
     * @return ValidationException
     */
    public static function ruleNotMappedException($rule): self
    {
        return new self("Could not find mapping for [$rule]");
    }

    public static function malformedUtf8(): self
    {
        return new self();
    }
}
