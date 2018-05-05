<?php

namespace Mbright\Validation\Rule\Validate;

class Url
{
    /**
     * Validates the value as a URL.
     *
     * The value must match a generic URL format; for example, ``http://example.com``, ``mms://example.org``, and so on.
     *
     * @param object $subject The subject to be filtered.
     * @param string $field The subject field name.
     *
     * @return bool True if valid, false if not.
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        if (!is_scalar($value)) {
            return false;
        }

        // first, make sure there are no invalid chars, list from ext/filter
        $other = "$-_.+"        // safe
            . "!*'(),"       // extra
            . "{}|\\^~[]`"   // national
            . "<>#%\""       // punctuation
            . ";/?:@&=";     // reserved

        $valid = 'a-zA-Z0-9' . preg_quote($other, '/');
        $clean = preg_replace("/[^$valid]/", '', $value);
        if ($value != $clean) {
            return false;
        }

        // now make sure it parses as a URL with scheme and host
        $result = @parse_url($value);
        if (empty($result['scheme']) || trim($result['scheme']) == '' ||
            empty($result['host'])   || trim($result['host']) == '') {
            return false;
        }

        return true;
    }
}
