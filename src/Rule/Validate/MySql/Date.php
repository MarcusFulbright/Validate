<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\ValidateRuleInterface;

/**
 * Validates that data can be inserted into one of the following column types:
 * - Date
 */
class Date implements ValidateRuleInterface
{
    /**
     * Returns a bool indicating if the value can be safely stored in a MySql Date column.
     *
     * @param object $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = (string) $subject->$field;
        $dateParts = $this->extractDateParts($value);

        return !is_null($dateParts) && checkdate($dateParts->month, $dateParts->day, $dateParts->year);
    }

    /**
     * Extract date parts from the given string.
     *
     * Will return a stdClass with 3 properties: year, month, day. Each property defaults to null. If the string cannot
     * be parsed, return null.
     *
     * @param string $dateString
     *
     * @return null|\stdClass
     */
    protected function extractDateParts(string $dateString): ?\stdClass
    {
        $extractedParts = (object) [
            'year' => null,
            'month' => null,
            'day' => null
        ];

        $sanitizedDateString = $this->sanitizeDateString($dateString);

        if (is_null($sanitizedDateString)) {
            return null;
        }

        // extract the individual date parts for checkdate
        $extractedParts->year = substr($sanitizedDateString, 0, 4);
        $extractedParts->month = substr($sanitizedDateString, 4, 2);
        $extractedParts->day = substr($sanitizedDateString, 6, 2);

        return $extractedParts;
    }

    /**
     * Sanitizes the given dateString to YYYYMMDD.
     *
     * Returns null if the string cannot be sanitized.
     *
     * @param string $dateString
     *
     * @return null|string
     */
    protected function sanitizeDateString(string $dateString): ?string
    {
        $sanitizedString = $this->handleDelimiters($dateString);
        if ($sanitizedString) {
            $sanitizedString = $this->normalizeYear($sanitizedString);
            // More than 8 characters here means we don't have the format YYYYMMDD
            if (strlen($sanitizedString) !== 8) {
                return null;
            }
        }

        return $sanitizedString;
    }

    /**
     * Strips delimiters from the given date string and returns the sanitized string.
     *
     * The returned string will be either
     *
     * @param string $dateString
     *
     * @return null|string
     */
    protected function handleDelimiters(string $dateString): ?string
    {
        // Grab everything that isn't an int, these things must be delimiters
        $delimiters = [];
        preg_match_all('/\D/', $dateString, $delimiters);

        if (count($delimiters[0]) > 1) {
            // ensure that all delimiters are valid delimiters accepted by mysql
            $delimiterString = implode('', $delimiters[0]);
            if (preg_match('/[^[:punct:]]/', $delimiterString) > 0) {
                return null;
            }

            // sanitize valid punctuation characters that are being used as delimiters
            $delimiterString = preg_quote($delimiterString, '/');
            // Remove delimiters to make parsing date segments easier
            $dateString = preg_replace("/[$delimiterString]/", '', $dateString);
        }

        return $dateString;
    }

    /**
     * Converts YYMMDD to YYYYMMDD.
     *
     * @param string $dateString
     *
     * @return null|string
     */
    public function normalizeYear(string $dateString): ?string
    {
        // if we have a two digit year, convert it to a 4 digit year for the sake of comparison
        if (strlen($dateString) === 6) {
            $twoDigitYear = substr($dateString, 0, 2);
            $yearPrefix = 0 < $twoDigitYear && $twoDigitYear < 69 ? '20' : '19';
            $dateString = $yearPrefix . $dateString;
        }

        return $dateString;
    }
}
