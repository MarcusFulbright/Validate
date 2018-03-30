<?php

namespace Nashphp\Validation\Exception;

class NashPhpValidationException extends \Exception
{
    /**
     * Returns an exception for a rule missing from a locator.
     *
     * @param $rule
     *
     * @return NashPhpValidationException
     */
    public static function ruleNotMappedException($rule): self
    {
        return new self("Could not find mapping for [$rule]");
    }
}
