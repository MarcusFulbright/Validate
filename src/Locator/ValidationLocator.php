<?php

namespace Nashphp\Validation\Locator;

use Nashphp\Validation\Rule\Validate\Alpha;
use Nashphp\Validation\Rule\Validate\AlphaDash;
use Nashphp\Validation\Rule\Validate\AlphaNum;
use Nashphp\Validation\Rule\Validate\Between;
use Nashphp\Validation\Rule\Validate\Boolean;
use Nashphp\Validation\Rule\Validate\Integer;

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
                return new Boolean();
            },
            'alphaNum' => function () {
                return new AlphaNum();
            },
            'alpha' => function () {
                return new Alpha();
            },
            'alphaDash' => function () {
                return new AlphaDash();
            },
            'between' => function () {
                return new Between();
            },
            'int' => function () {
                return new Integer();
            }
        ];
    }
}
