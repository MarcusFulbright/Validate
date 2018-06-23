<?php

namespace Mbright\Validation\Rule\Validate;

class IpAddress implements ValidateRuleInterface
{
    /** @var mixed|null */
    protected $flags;

    /**
     * @param mixed $flags `FILTER_VALIDATE_IP` flags to pass to filter_var();
     * cf. <http://php.net/manual/en/filter.filters.flags.php>.
     */
    public function __construct($flags = null)
    {
        $this->flags = $flags;
    }

    /**
     * Validates that the value is an IP address.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        if ($this->flags === null) {
            $this->flags = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6;
        }
        $value = $subject->$field;

        return filter_var($value, FILTER_VALIDATE_IP, $this->flags) !== false;
    }
}
