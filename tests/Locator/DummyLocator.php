<?php

namespace Nashphp\Validation\Tests\Locator;

use Nashphp\Validation\Locator\AbstractLocator;

class DummyLocator extends AbstractLocator
{
    public function getDefaultFactories(): array
    {
        return [
            'foo' => function () {
                return function () {
                    return 'foo';
                };
            }
        ];
    }
}
