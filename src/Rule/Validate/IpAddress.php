<?php

namespace Mbright\Validation\Rule\Validate;

class IpAddress
{
    /**
     * Validates that the value is an IP address.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param mixed $flags `FILTER_VALIDATE_IP` flags to pass to filter_var();
     * cf. <http://php.net/manual/en/filter.filters.flags.php>.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field, $flags = null): bool
    {
        if ($flags === null) {
            $flags = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6;
        }
        $value = $subject->$field;

        return filter_var($value, FILTER_VALIDATE_IP, $flags) !== false;
    }
}
