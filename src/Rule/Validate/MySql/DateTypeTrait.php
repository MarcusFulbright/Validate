<?php

namespace Mbright\Validation\Rule\Validate\MySql;

/**
 * Functions to parse a given string to extract year, month, and day parts.
 *
 * A regex pattern (excluding the surrounding /'s) must be provided that should match all valid delimiters that can
 * separate year, month, and day parts. Optionally, YYMMDD strings be sanitized to have a 4 digit year YYYYMMDD format.
 *
 * A null return indicates that the string could not be parsed into YYMMDD or YYYYMMDD.
 */
trait DateTypeTrait
{
    /**
     * Extract date parts from the given string.
     *
     * Will return a stdClass with 3 properties: year, month, day. Each property defaults to null. If the string cannot
     * be parsed, return null.
     *
     * @param string $dateString
     * @param string $delimiterPattern regex pattern to use when searching for delimiters (excluding the surrounding /'s
     * @param bool normalizeYear indicates if a two digit year should get normalized to a 4 digit year
     *
     * @return null|\stdClass
     */
    protected function extractDateParts(string $dateString, string $delimiterPattern, bool $normalizeYear): ?\stdClass {
        $extractedParts = (object) [
            'year' => null,
            'month' => null,
            'day' => null
        ];

        $sanitizedDateString = $this->sanitizeDateString($dateString, $delimiterPattern, $normalizeYear);

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
     * @param string $delimiterPattern regex pattern to use when searching for delimiters (excluding the surrounding /'s
     * @param bool normalizeYear indicates if a two digit year should get normalized to a 4 digit year
     *
     * @return null|string
     */
    private function sanitizeDateString(string $dateString, string $delimiterPattern, bool $normalizeYear): ?string
    {
        $sanitizedString = $this->handleDelimiters($dateString, $delimiterPattern);

        if ($sanitizedString && $normalizeYear) {
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
     * @param string $delimiterPattern regex pattern to use when searching for delimiters (excluding the surrounding /'s
     *
     * @return null|string
     */
    private function handleDelimiters(string $dateString, string $delimiterPattern): ?string
    {
        // Grab everything that isn't an int, these things must be delimiters
        $delimiters = [];
        preg_match_all("/\D/", $dateString, $delimiters);

        if (count($delimiters[0]) > 1) {
            // ensure that all delimiters are valid delimiters accepted by mysql
            $delimiterString = implode('', $delimiters[0]);

            if (preg_match("/$delimiterPattern/", $delimiterString) > 0) {
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
    private function normalizeYear(string $dateString): ?string
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
