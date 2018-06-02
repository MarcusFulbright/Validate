<?php

namespace Mbright\Validation\Rule;

use Mbright\Validation\Exception\MalformedUtf8Exception;

class AbstractStringCase
{
    /**
     * Proxy to `mb_convert_case()` when available; fall back to `utf8_decode()` and `strtolower()` otherwise.
     *
     * @param string $str string to convert case.
     *
     * @return string
     */
    protected function strtolower($str)
    {
        if ($this->mbstring()) {
            return mb_convert_case($str, MB_CASE_LOWER, 'UTF-8');
        }

        return strtolower(utf8_decode($str));
    }

    /**
     * Proxy to `mb_convert_case()` when available; fall back to `utf8_decode()` and `strtoupper()` otherwise.
     *
     * @param string $str string to convert case.
     *
     * @return string
     */
    protected function strtoupper($str)
    {
        if ($this->mbstring()) {
            return mb_convert_case($str, MB_CASE_UPPER, 'UTF-8');
        }

        return strtoupper(utf8_decode($str));
    }

    /**
     * Proxy to `mb_convert_case()` when available; fall back to `utf8_decode()` and `ucwords()` otherwise.
     *
     * @param string $str string to convert case.
     *
     * @return int
     */
    protected function ucwords($str)
    {
        if ($this->mbstring()) {
            return mb_convert_case($str, MB_CASE_TITLE, 'UTF-8');
        }

        return ucwords(utf8_decode($str));
    }

    /**
     * Proxy to `mb_convert_case()` when available; fall back to `utf8_decode()` and `strtoupper()` otherwise.
     *
     * @param string $str string to convert case.
     *
     * @return int
     */
    protected function ucfirst($str)
    {
        $len = $this->strlen($str);
        if ($len == 0) {
            return '';
        }
        if ($len > 1) {
            $head = $this->substr($str, 0, 1);
            $tail = $this->substr($str, 1, $len - 1);

            return $this->strtoupper($head) . $tail;
        }

        return $this->strtoupper($str);
    }

    /**
     * Proxy to `mb_convert_case()` when available; fall back to `utf8_decode()` and `strtolower()` otherwise.
     *
     * @param string $str string to convert case.
     *
     * @return int
     */
    protected function lcfirst($str)
    {
        $len = $this->strlen($str);
        if ($len == 0) {
            return '';
        }
        if ($len > 1) {
            $head = $this->substr($str, 0, 1);
            $tail = $this->substr($str, 1, $len - 1);

            return $this->strtolower($head) . $tail;
        }

        return $this->strtolower($str);
    }

    /**
     * Is the `mbstring` extension loaded?
     *
     * @return bool
     */
    protected function mbstring()
    {
        return extension_loaded('mbstring');
    }

    /**
     * Is the `iconv` extension loaded?
     *
     * @return bool
     */
    protected function iconv()
    {
        return extension_loaded('iconv');
    }

    /**
     * Proxy to `iconv_strlen()` or `mb_strlen()` when available; fall back to `utf8_decode()` and `strlen()` otherwise.
     *
     * @param string $str Return the number of characters in this string.
     *
     * @return int
     */
    protected function strlen($str)
    {
        if ($this->iconv()) {
            return $this->strlenIconv($str);
        }

        if ($this->mbstring()) {
            return mb_strlen($str, 'UTF-8');
        }

        return strlen(utf8_decode($str));
    }

    /**
     * Wrapper for `iconv_substr()` to throw an exception on malformed UTF-8.
     *
     * @param string $str The string to work with.
     * @param int $start Start at this position.
     * @param int $length End after this many characters.
     * @return string
     *
     * @throws MalformedUtf8Exception
     */
    protected function substrIconv($str, $start, $length)
    {
        $level = error_reporting(0);
        $substr = iconv_substr($str, $start, $length, 'UTF-8');
        error_reporting($level);

        if ($substr !== false) {
            return $substr;
        }

        throw new MalformedUtf8Exception();
    }

    /**
     * Wrapper for `iconv_strlen()` to throw an exception on malformed UTF-8.
     *
     * @param string $str Return the number of characters in this string.
     *
     * @throws MalformedUtf8Exception
     *
     * @return int
     */
    protected function strlenIconv($str)
    {
        $level = error_reporting(0);
        $strlen = iconv_strlen($str, 'UTF-8');
        error_reporting($level);

        if ($strlen !== false) {
            return $strlen;
        }

        throw new MalformedUtf8Exception();
    }

    /**
     * Proxy to `iconv_substr()` or `mb_substr()` when the `mbstring` available; polyfill via `preg_split()` and
     * `array_slice()` otherwise.
     *
     * @param string $str The string to work with.
     * @param int $start Start at this position.
     * @param int $length End after this many characters.
     *
     * @return string
     */
    protected function substr($str, $start, $length = null)
    {
        if ($this->iconv()) {
            return $this->substrIconv($str, $start, $length);
        }

        if ($this->mbstring()) {
            return mb_substr($str, $start, $length, 'UTF-8');
        }

        $split = preg_split("//u", $str, -1, PREG_SPLIT_NO_EMPTY);

        return implode('', array_slice($split, $start, $length));
    }

    /**
     * Userland UTF-8-aware implementation of `str_pad()`.
     *
     * @param string $input The input string.
     * @param int $pad_length If the value of pad_length is negative, less than, or equal to the length of the input
     * string, no padding takes place.
     * @param string $pad_str Pad with this string. The pad_string may be truncated if the required number of padding
     * characters can't be evenly divided by the pad_string's length.
     * @param int $pad_type Optional argument pad_type can be STR_PAD_RIGHT, STR_PAD_LEFT, or STR_PAD_BOTH. If pad_type
     * is not specified it is assumed to be STR_PAD_RIGHT.
     *
     * @return string
     */
    protected function strpad($input, $padLength, $padStr = ' ', $padType = STR_PAD_RIGHT)
    {
        $inputLen = $this->strlen($input);
        if ($padLength <= $inputLen) {
            return $input;
        }

        $padStrLen = $this->strlen($padStr);
        $padLen = $padLength - $inputLen;

        if ($padType == STR_PAD_LEFT) {
            $repeatTimes = ceil($padLen / $padStrLen);
            $prefix = str_repeat($padStr, $repeatTimes);

            return $this->substr($prefix, 0, floor($padLen)) . $input;
        }

        if ($padType == STR_PAD_BOTH) {
            $padLen /= 2;
            $padAmountLeft = floor($padLen);
            $padAmountRight = ceil($padLen);
            $repeatTimesLeft = ceil($padAmountLeft / $padStrLen);
            $repeatTimesRight = ceil($padAmountRight / $padStrLen);

            $prefix = str_repeat($padStr, $repeatTimesLeft);
            $paddingLeft = $this->substr($prefix, 0, $padAmountLeft);

            $suffix = str_repeat($padStr, $repeatTimesRight);
            $paddingRight = $this->substr($suffix, 0, $padAmountRight);

            return $paddingLeft . $input . $paddingRight;
        }

        // STR_PAD_RIGHT
        $repeatTimes = ceil($padLen / $padStrLen);
        $input .= str_repeat($padStr, $repeatTimes);
        return $this->substr($input, 0, $padLength);
    }
}
