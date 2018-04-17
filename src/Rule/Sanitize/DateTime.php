<?php

namespace Mbright\Validation\Rule\Sanitize;

class DateTime
{
    /**
     * Sanitize a datetime to a specified format, default "Y-m-d H:i:s".
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     * @param string $format The date format to use.
     *
     * @return bool True if the value was sanitized, false if not.
     */
    public function __invoke($subject, string $field, $format = 'Y-m-d H:i:s'): bool
    {
        $value = $subject->$field;
        $datetime = $this->newDateTime($value);
        if (!$datetime) {
            return false;
        }
        $subject->$field = $datetime->format($format);

        return true;
    }

    /**
     * Returns a new DateTime object.
     *
     * @param mixed $value The incoming date/time value.
     *
     * @return mixed If the value is already a DateTime then it is returned
     * as-is; if the value is invalid as a date/time then `false` is returned;
     * otherwise, a new DateTime is constructed from the value and returned.
     */
    protected function newDateTime($value)
    {
        if ($value instanceof \DateTime) {
            return $value;
        }

        if (!is_scalar($value)) {
            return false;
        }

        if (trim($value) === '') {
            return false;
        }

        $datetime = date_create($value);
        // invalid dates (like 1979-02-29) show up as warnings.
        $errors = \DateTime::getLastErrors();
        if ($errors['warnings']) {
            return false;
        }
        // looks OK
        return $datetime;
    }
}
