<?php

namespace Nashphp\Validation\Locator;

use Nashphp\Validation\Rule\Validate\IsAlpha;
use Nashphp\Validation\Rule\Validate\IsAlphaDash;
use Nashphp\Validation\Rule\Validate\IsAlphaNum;
use Nashphp\Validation\Rule\Validate\IsBetween;
use Nashphp\Validation\Rule\Validate\IsBool;

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
            'bool' => function () {
                return new IsBool();
            },
            'alphaNum' => function () {
                return new IsAlphaNum();
            },
            'alpha' => function () {
                return new IsAlpha();
            },
            'alphaDash' => function () {
                return new IsAlphaDash();
            },
            'between' => function () {
                return new IsBetween();
            }
        ];
    }
}
