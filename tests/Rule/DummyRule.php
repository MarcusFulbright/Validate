<?php

namespace Nashphp\Validation\Tests;

use Nashphp\Validation\Rule\RuleInterface;

class DummyRule implements RuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        return true;
    }
}
