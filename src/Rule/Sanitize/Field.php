<?php

namespace Mbright\Validation\Rule\Sanitize;

class Field implements SanitizeRuleInterface
{
    /** @var string */
    protected $otherField;

    /**
     * @param string $other_field The name of the other subject field.
     */
    public function __construct(string $otherField)
    {
        $this->otherField = $otherField;
    }

    /**
     * Modifies the field value to match that of another field.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        // the other field needs to exist and *not* be null
        if (! isset($subject->{$this->otherField})) {
            return false;
        }
        $subject->$field = $subject->{$this->otherField};

        return true;
    }
}
