<?php

namespace Mbright\Validation\Rule;

class AbstractUuidCase
{
    /**
     * Does the value match the canonical UUID format?
     *
     * @param string $value The value to be checked.
     *
     * @return bool
     */
    protected function isCanonical($value)
    {
        $regex = '/^[a-f0-9]{8}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{4}-[a-f0-9]{12}$/i';

        return (bool) preg_match($regex, $value);
    }

    /**
     * Is the value a hex-only UUID?
     *
     * @param string $value The value to be checked.
     *
     * @return bool
     */
    protected function isHexOnly($value)
    {
        $regex = '/^[a-f0-9]{32}$/i';

        return (bool) preg_match($regex, $value);
    }
}
