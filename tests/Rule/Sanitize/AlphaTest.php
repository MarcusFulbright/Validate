<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class AlphaTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            ['^&* abc 123 ,./', true, 'abc'],
            ['^&* abc гдб 123 ,./', true, 'abcгдб'],
        ];
    }
}
