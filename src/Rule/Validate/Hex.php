<?php

namespace Mbright\Validation\Rule\Validate;

class Hex implements ValidateRuleInterface
{
    /** @var int */
    protected $max;


    /**
     * @param int|null $max Maximum "ceiling" value for the hex
     */
    public function __construct(int $max = null)
    {
        $this->max = $max;
    }

    /**
     * Sanitizes a value to a hex.
     *
     * @param $subject
     * @param $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if (!is_scalar($value)) {
            return false;
        }

        $hex = ctype_xdigit($value);
        if (!$hex) {
            return false;
        }

        if ($this->max && strlen($value) > $this->max) {
            return false;
        }

        return true;
    }
}
