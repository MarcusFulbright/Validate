<?php

namespace Mbright\Validation\Rule\Sanitize;

use Mbright\Validation\Rule\AbstractDateTime;

class DateTime extends AbstractDateTime implements SanitizeRuleInterface
{
    /** @var string */
    protected $format;

    /**
     * @param string $format DateTime Format to use
     */
    public function __construct(string $format = 'Y-m-d H:i:s')
    {
        $this->format = $format;
    }

    /**
     * Sanitize a datetime to a specified format, default "Y-m-d H:i:s".
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        $datetime = $this->newDateTime($value);
        if (!$datetime) {
            return false;
        }
        $subject->$field = $datetime->format($this->format);

        return true;
    }
}
