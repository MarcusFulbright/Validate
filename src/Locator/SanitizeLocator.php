<?php

namespace Mbright\Validation\Locator;

use Mbright\Validation\Rule\Sanitize;

class SanitizeLocator extends AbstractLocator
{
    /**
     * Returns all of the validation rules provided by this package.
     *
     * These rules are used as the default sanitize rules supplied to the ValidationService
     *
     * @return array
     */
    protected function getDefaultFactories(): array
    {
        return [
            'alphaNum' => function () {
                return new Sanitize\AlphaNum();
            },
            'alpha' => function () {
                return new Sanitize\Alpha();
            },
            'between' => function () {
                return new Sanitize\Between();
            },
            'bool' => function () {
                return new Sanitize\Boolean();
            },
            'callback' => function () {
                return new Sanitize\Callback();
            },
            'dateTime' => function () {
                return new Sanitize\DateTime();
            },
            'double' => function () {
                return new Sanitize\Double();
            },
            'hex' => function () {
                return new Sanitize\Hex();
            },
            'int' => function () {
                return new Sanitize\Integer();
            },
            'isbn' => function () {
                return new Sanitize\Isbn();
            },
            'lowercase' => function () {
                return new Sanitize\Lowercase();
            },
            'lowercaseFirst' => function () {
                return new Sanitize\LowercaseFirst();
            },
            'matchField' => function () {
                return new Sanitize\MatchField();
            },
            'max' => function () {
                return new Sanitize\Max();
            },
            'min' => function () {
                return new Sanitize\Min();
            },
            'now' => function () {
                return new Sanitize\Now();
            },
            'regex' => function () {
                return new Sanitize\Regex();
            },
            'remove' => function () {
                return new Sanitize\Remove();
            },
            'str' => function () {
                return new Sanitize\Str();
            },
            'strBetween' => function () {
                return new Sanitize\StrBetween();
            },
            'strLen' => function () {
                return new Sanitize\Strlen();
            },
            'strLenMax' => function () {
                return new Sanitize\StrlenMax();
            },
            'strLenMin' => function () {
                return new Sanitize\StrlenMin();
            },
            'titleCase' => function () {
                return new Sanitize\TitleCase();
            },
            'trim' => function () {
                return new Sanitize\Trim();
            },
            'uppercase' => function () {
                return new Sanitize\Uppercase();
            },
            'uppercaseFirst' => function () {
                return new Sanitize\UppercaseFirst();
            },
            'uuid' => function () {
                return new Sanitize\Uuid();
            },
            'uuidHexOnly' => function () {
                return new Sanitize\UuidHexOnly();
            },
            'value' => function () {
                return new Sanitize\Value();
            },
            'word' => function () {
                return new Sanitize\Word();
            }
        ];
    }
}
