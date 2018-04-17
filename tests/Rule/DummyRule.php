<?php

namespace Mbright\Validation\Tests;

class DummyRule
{
    public function __invoke($subject, string $field): bool
    {
        return true;
    }
}
