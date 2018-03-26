<?php

namespace Nashphp\Validation\Rule;

interface RuleInterface
{
    public function __invoke(object $subject, string $field): bool;
}
