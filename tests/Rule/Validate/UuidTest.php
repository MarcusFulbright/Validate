<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class UuidTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ['12345678-90ab-cdef-1234-567890123456'],
            ['12345678-90Ab-cdef-1234-5678901abc56'],
            ['12345678-90ab-cdef-1234-567890123456'],
            ['11111111-1111-1111-1111-111111111111'],
            ['aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaa'],
        ];
    }

    public function providerIsNot()
    {
        return [
            ['1000067890abcdef1234562340123456'],
            ['12345678-90ab-cdef-1234-5678901234567'],
            ['123-34324'],
            ['97844444-asdf-fgfd-vf45-383621139112'],
            ['aaaaaaaa-aaaa-aaaa-aaaa-aaaaaaaaaaaaa'],
            ['10000678-90ab-cdef-1234-56240&123456'],
            ['100Ga678-90ab-cdef-1234-562340&123456'],
            ['100Aa678-90ab-cdef-1234-562340&123456'],
            [''],
        ];
    }
}
