<?php

namespace Mbright\Validation\Rule\Sanitize;

class Hex
{
    /** @var int|null */
    protected $max;

    /**
     * @param int|null $max
     */
    public function __construct(int $max = null)
    {
        $this->max = $max;
    }

    /**
     * @param $subject
     * @param $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if (!is_scalar($value)) {
            return false;
        }

        $value = preg_replace('/[^0-9a-f]/i', '', $value);
        if ($value === '') {
            return false;
        }

        if ($this->max && strlen($value) > $this->max) {
            $value = substr($value, 0, $this->max);
        }

        $subject->$field = $value;

        return true;
    }
}
