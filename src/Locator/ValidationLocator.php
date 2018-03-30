<?php

namespace Nashphp\Validation\Locator;

use Nashphp\Validation\Rule\Validate\IsBool;

class ValidationLocator extends AbstractLocator
{
    /**
     * Returns all of the validation rules provided by this package.
     *
     * These rules are used as the default validation rules supplied to the ValidationService
     *
     * @return array
     */
    protected function getDefaultFactories(): array
    {
        return [
            'isBool' => function () {
                return new IsBool();
            },
        ];
    }
}
