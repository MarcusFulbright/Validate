<?php

namespace Mbright\Validation\Tests;

use Mbright\Validation\Rule\RuleInterface;

class DummyRule implements RuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        return true;
    }
}
