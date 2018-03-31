<?php

namespace Nashphp\Validation\Locator;

use Nashphp\Validation\Rule\Validate\IsAlpha;
use Nashphp\Validation\Rule\Validate\IsAlphaDash;
use Nashphp\Validation\Rule\Validate\IsAlphaNum;
use Nashphp\Validation\Rule\Validate\IsBetween;
use Nashphp\Validation\Rule\Validate\IsBool;
use Nashphp\Validation\Tests\Rule\Validate\IsBetweenTest;

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
            'isBool' => function () {
                return new IsBool();
            },
            'isAlphaNum' => function () {
                return new IsAlphaNum();
            },
            'isAlpha' => function () {
                return new IsAlpha();
            },
            'isAlphaDash' => function () {
                return new IsAlphaDash();
            },
            'isBetween' => function () {
                return new IsBetween();
            }
        ];
    }
}
