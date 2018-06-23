<?php

namespace Mbright\Validation\Rule\Validate;

class EqualToField implements ValidateRuleInterface
{
    /** @var string */
    protected $otherField;

    /**
     * @param string $otherField Check against the value of this field on the subject.
     */
    public function __construct(string $otherField)
    {
        $this->otherField = $otherField;
    }

    /**
     * Validates that this value is loosely equal to some other subject field.
     *
     * If the other element does not exist in $subject, or is null, the validation will fail.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the values are equal, false if not equal.
     */
    public function __invoke($subject, string $field): bool
    {
        if (!isset($subject->{$this->otherField})) {
            return false;
        }

        return $subject->$field == $subject->{$this->otherField};
    }
}
