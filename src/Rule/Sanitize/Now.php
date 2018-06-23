<?php

namespace Mbright\Validation\Rule\Sanitize;

class Now implements SanitizeRuleInterface
{
    /** @var string */
    protected $format;

    /**
     * @param string $format
     */
    public function __construct(string $format = 'Y-m-d H:i:s')
    {
        $this->format = $format;
    }

    /**
     * Force the value to the current time, default format "Y-m-d H:i:s".
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool Always true.
     */
    public function __invoke($subject, string $field): bool
    {
        $subject->$field = date($this->format);

        return true;
    }
}
