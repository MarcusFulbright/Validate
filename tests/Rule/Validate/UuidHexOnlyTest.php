<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class UuidHexOnlyTest extends AbstractValidateTest
{
    public function providerIs()
    {
        // random 32-char hex strings
        $data = [];
        for ($i = 1; $i <= 10; $i ++) {
            $data[] = [md5(mt_rand())];
        }
        return $data;
    }

    public function providerIsNot()
    {
        return [
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
