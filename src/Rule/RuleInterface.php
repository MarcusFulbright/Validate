<?php

namespace Nashphp\Validation\Rule;

interface RuleInterface
{
    public function __invoke($subject, string $field): bool;
}
