<?php

namespace Nashphp\Validation\Rule\Validate;

use Nashphp\Validation\Rule\RuleInterface;

class IsAlphaNum implements RuleInterface
{
    /**
     * Returns bool indicating if the value consists of only alpha numeric characters.
     *
     * @param $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if (!is_string($value) && !is_numeric($value)) {
            return false;
        }

        return preg_match('/^[\pL\pM\pN]+$/u', $value) > 0;
    }
}