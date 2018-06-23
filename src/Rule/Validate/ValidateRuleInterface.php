<?php

namespace Mbright\Validation\Rule\Validate;

/**
 * This interface is for _all_ Validate rules including any custom rules.
 *
 * Validation rules _cannot_ manipulate the subject. They should only return a boolean that indicates if the rule passed
 * or not. If the rule is used with a `isNot()` call, the Validator will handle inverting the return value of the rule.
 */
interface ValidateRuleInterface
{
    /**
     * @param object $subject The subject being validated. Will always be an object
     * @param string $field Name for the field that's being operated on
     *
     * @return bool Indicates success
     */
    public function __invoke($subject, string $field): bool;
}
