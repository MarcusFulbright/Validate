<?php

namespace Mbright\Validation\Rule\Sanitize;

class Regex implements SanitizeRuleInterface
{
    /** @var string  */
    protected $expr;

    /** @var string */
    protected $replace;

    /**
     * @param string $expr The regular expression pattern to apply.
     * @param string $replace Value to replace the found pattern with
     */
    public function __construct(string $expr, string $replace)
    {
        $this->expr = $expr;
        $this->replace =$replace;
    }

    /**
     * Applies `preg_replace()` to the value.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }
        $subject->$field = preg_replace($this->expr, $this->replace, $value);

        return true;
    }
}
