<?php

namespace Mbright\Validation\Rule\Validate\MySql;

trait TimeTypeTrait
{
    /**
     * Extracts time parts from the given string.
     *
     * Will return an object with 3 properties, hours, minutes, seconds with the values from the string. Each property
     * defaults to zero. If the string cannot be parsed, return null.
     *
     * @param $value
     *
     * @return ?\stdClass
     */
    protected function extractTimeParts($value): ?\stdClass
    {
        $extractedParts = (object) [
            'hours' => 0,
            'minutes' => 0,
            'seconds'=> 0
        ];

        $timeSegments = explode(':', $value);
        $numOfSegments = count($timeSegments);

        if ($numOfSegments === 3) {
            $extractedParts->hours = $timeSegments[0];
            $extractedParts->minutes = $timeSegments[1];
            $extractedParts->seconds = $timeSegments[2];
        } elseif ($numOfSegments === 2) {
            $extractedParts->hours = $timeSegments[0];
            $extractedParts->minutes = $timeSegments[1];
        } elseif ($numOfSegments === 1) {
            // if a 3rd character is present and equal to . then we have a SS format segment else it has to be HHMMSS
            $isSecondsOnly = substr($timeSegments[0], 2, 1) !== '.';
            if ($isSecondsOnly) {
                $extractedParts->seconds = $timeSegments[0];
            } else {
                $extractedParts = $this->handleNonDelimitedString($timeSegments[0], $extractedParts);
            }
        } else {
            $extractedParts = null;
        }

        return $extractedParts;
    }

    /**
     * Handles HHHMMSS formatted strings.
     *
     * @param string $timeString
     * @param \stdClass $extractedParts
     *
     * @return null|\stdClass
     */
    private function handleNonDelimitedString(string $timeString, \stdClass $extractedParts)
    {
        $parsedSegments = [];
        preg_match('(^\d{2})(\d{2})(\d{2}\.\d+$|\d{2}$)', $timeString, $parsedSegments);

        if (count($parsedSegments) !== 4) {
            return null;
        }

        $extractedParts->hours = $parsedSegments[0];
        $extractedParts->minutes = $parsedSegments[1];
        $extractedParts->seconds = $parsedSegments[2];

        return $extractedParts;
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

        return $hours >= -838 && $hours <= 838;
    }
}
