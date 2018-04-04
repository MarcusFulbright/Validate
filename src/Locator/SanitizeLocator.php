<?php

namespace Nashphp\Validation\Locator;

use Nashphp\Validation\Rule\Sanitize\ToBool;

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
            'bool' => function () {
                return new ToBool();
            }
        ];
    }
}
