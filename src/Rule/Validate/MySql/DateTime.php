<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\ValidateRuleInterface;

/**
 * Validates that data can be inserted into one of the following column types:
 * - Time
 */
class DateTime implements ValidateRuleInterface
{
    use DateTypeTrait, TimeTypeTrait;

    /**
     * * Indicates if the given field's value is a MySql safe DateTime.
     *
     * @param object $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if (!is_string($value)) {
            return false;
        }

        $dateTimeDelimiter = substr($value, 10, 1);

        if (! in_array($dateTimeDelimiter,  [' ', 'T'])) {
            return false;
        }

        $separated = explode($dateTimeDelimiter, $value);

        return $this->validateDate($separated[0]) && $this->validateTime($separated[1]);
    }

    /**
     * Validates that the string can represent a date.
     *
     * Valid formats include: YY-MM-DD and YYYY-MM-DD.
     *
     * @param string $dateString
     *
     * @return bool
     */
    protected function validateDate(string $dateString): bool
    {
        $dateParts = $this->extractDateParts($dateString, '[^[:punct:]]', true);

        return !is_null($dateParts) && checkdate($dateParts->month, $dateParts->day, $dateParts->year);
    }

    /**
     * Validates that the string can represent a time.
     *
     * @param string $timeString
     *
     * @return bool
     */
    protected function validateTime(string $timeString): bool
    {
        $timeParts = $this->extractTimeParts($timeString);

        return ! is_null($timeParts)
            && $this->validateHours($timeParts->hours)
            && $this->validateMinutes($timeParts->minutes)
            && $this->validateSeconds($timeParts->seconds);
    }

    /**
     * Validates that the string can represent seconds.
     *
     * @param string $seconds
     *
     * @return bool
     */
    protected function validateSeconds(string $seconds): bool
    {
        $precision = strlen(substr(strrchr($seconds, '.'), 1));

        if ($precision > 6) {
            return false;
        }

        $seconds = (float) $seconds;

        return $seconds >= 0 && $seconds < 60;
    }

    /**
     * Validates that the string can represent minutes.
     *
     * @param string $minutes
     *
     * @return bool
     */
    protected function validateMinutes(string $minutes): bool
    {
        $minutes = (int) $minutes;

        return $minutes >= 0 && $minutes < 60;
    }

    /**
     * Validates tha the string can represent hours.
     *
     * @param string $hours
     *
     * @return bool
     */
    protected function validateHours(string $hours): bool
    {
        $hours = (int) $hours;

        return $hours >= 0 && $hours <= 23;
    }
}
