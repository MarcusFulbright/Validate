<?php

namespace Mbright\Validation\Tests\Locator;

use Mbright\Validation\Locator\AbstractLocator;

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
