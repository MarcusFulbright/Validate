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
            'int' => function () {
                return new Sanitize\Integer();
            }
        ];
    }
}
