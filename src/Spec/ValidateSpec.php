<?php

namespace Nashphp\Validation\Spec;

class ValidateSpec extends AbstractSpec
{
    protected function getDefaultMessage(): string
    {
        return "{$this->field} did not pass " . parent::getDefaultMessage();
    }
}
