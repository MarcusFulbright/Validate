<?php

namespace Mbright\Validation\Rule\Sanitize;

class StringVal implements SanitizeRuleInterface
{
    /** @var null */
    protected $find;

    /** @var null */
    protected $replace;

    /**
     * @param string|array $find Find this/these in the value.
     * @param string|array $replace Replace with this/these in the value.
     *
     */
    public function __construct($find = null, $replace = null)
    {
        $this->find = $find;
        $this->replace = $replace;
    }

    /**
     * Forces the value to a string, optionally applying `str_replace()`.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = (string) $subject->$field;
        if ($this->find || $this->replace) {
            $value = str_replace($this->find, $this->replace, $value);
        }
        $subject->$field = $value;

        return true;
    }
}
