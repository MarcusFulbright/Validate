<?php

namespace Mbright\Validation\Rule\Validate;

class Between implements ValidateRuleInterface
{
    /** @var int */
    protected $min;
    
    /** @var int */
    protected $max;

    /**
     * @param int $min minimum 'floor' value
     * @param int $max maximum 'ceiling' value
     */
    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    /**
     * Validates that a field's value is between the given min and max.
     *
     * @param $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        return ($value >= $this->min && $value <= $this->max);
    }
}
