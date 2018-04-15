<?php

namespace Mbright\Validation\Locator;

use Mbright\Validation\Rule\Sanitize\Boolean;
use Mbright\Validation\Rule\Sanitize\Integer;

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
                return new Boolean();
            },
            'int' => function () {
                return new Integer();
            }
        ];
    }
}
