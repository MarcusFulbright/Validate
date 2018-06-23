<?php

namespace Mbright\Validation\Rule\Validate;

class InKeys implements ValidateRuleInterface
{
    /** @var array */
    protected $array;

    /**
     * @param array $array An array of key-value pairs; the value must match one of the keys in this array.
     */
    public function __construct(array $array)
    {
        $this->array = $array;
    }

    /**
     * Validates that the value is a key in a given array.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (!is_string($value) && !is_int($value)) {
            // array_key_exists errors on non-string non-int keys.
            return false;
        }
        // using array_keys() converts string numeric keys to integers, which is *not* the behavior we want.
        return array_key_exists($subject->$field, $this->array);
    }
}
