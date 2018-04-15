<?php

namespace Mbright\Validation\Rule;

interface RuleInterface
{
    public function __invoke($subject, string $field): bool;
}
