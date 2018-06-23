<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractBooleanCase;

class Boolean extends AbstractBooleanCase implements SanitizeRuleInterface
{
    /** @var bool|mixed */
    protected $trueValue;

    /** @var bool|mixed */
    protected $falseValue;

    /**
     * @param bool $true Use this value for `true`.
     * @param bool $false Use this value for `false`.
     */
    public function __construct($true = true, $false = false)
    {
        $this->trueValue = $true;
        $this->falseValue = $false;
    }

    /**
     * Sanitize the value to a boolean, or a pseudo-boolean.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param mixed $true Use this value for `true`.
     * @param mixed $false Use this value for `false`.
     *
     * @return bool Always true.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if ($this->isTrue($value)) {
            $subject->$field = $this->trueValue;

            return true;
        }

        if ($this->isFalse($value)) {
            $subject->$field = $this->falseValue;

            return true;
        }

        $subject->$field = $value ? $this->trueValue : $this->falseValue;

        return true;
    }
}
