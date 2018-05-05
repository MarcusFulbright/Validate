<?php

namespace Mbright\Validation\Locator;

use Mbright\Validation\Rule\Validate;

class ValidationLocator extends AbstractLocator
{
    /**
     * Returns all of the validation rules provided by this package.
     *
     * These rules are used as the default validation rules supplied to the Validator.
     *
     * @return array
     */
    protected function getDefaultFactories(): array
    {
        return [
            'alpha' => function () {
                return new Validate\Alpha();
            },
            'alphaDash' => function () {
                return new Validate\AlphaDash();
            },
            'alphaNum' => function () {
                return new Validate\AlphaNum();
            },
            'between' => function () {
                return new Validate\Between();
            },
            'bool' => function () {
                return new Validate\Boolean();
            },
            'callback' => function () {
                return new Validate\Callback();
            },
            'creditCard' => function () {
                return new Validate\CreditCard();
            },
            'dateTime' => function () {
                return new Validate\DateTime();
            },
            'double' => function () {
                return new Validate\Double();
            },
            'email' => function () {
                return new Validate\Email();
            },
            'equalToField' => function () {
                return new Validate\EqualToField();
            },
            'equalToValue' => function () {
                return new Validate\EqualToValue();
            },
            'hex' => function () {
                return new Validate\Hex();
            },
            'inKeys' => function () {
                return new Validate\InKeys();
            },
            'int' => function () {
                return new Validate\Integer();
            },
            'inValues' => function () {
                return new Validate\InValues();
            },
            'ipAddress' => function () {
                return new Validate\IpAddress();
            },
            'isbn'=> function () {
                return new Validate\Isbn();
            },
            'locale' => function () {
                return new Validate\Locale();
            },
            'lowercase' => function () {
                return new Validate\Lowercase();
            },
            'lowercaseFirst' => function () {
                return new Validate\LowercaseFirst();
            },
            'max' => function () {
                return new Validate\Max();
            },
            'min' => function () {
                return new Validate\Min();
            },
            'regex' => function () {
                return new Validate\Regex();
            },
            'str' => function () {
                return new Validate\Str();
            },
            'strictEqualToField' => function () {
                return new Validate\EqualToField();
            },
            'strictEqualToValue' => function () {
                return new Validate\StrictEqualToValue();
            },
            'strlen' => function () {
                return new Validate\Strlen();
            },
            'strlenBetween' => function () {
                return new Validate\StrlenBetween();
            },
            'strlenMax' => function () {
                return new Validate\StrlenMax();
            },
            'strlenMin' => function () {
                return new Validate\StrlenMin();
            },
            'titleCase' => function () {
                return new Validate\TitleCase();
            },
            'trim' => function () {
                return new Validate\Trim();
            },
            'upload' => function () {
                return new Validate\Upload();
            },
            'uppercase' => function () {
                return new Validate\Uppercase();
            },
            'uppercaseFirst' => function () {
                return new Validate\UppercaseFirst();
            },
            'url' => function () {
                return new Validate\Url();
            },
            'uuid' => function () {
                return new Validate\Uuid();
            },
            'uuidHexOnly' => function () {
                return new Validate\UuidHexOnly();
            },
            'word' => function () {
                return new Validate\Word();
            }
        ];
    }
}
