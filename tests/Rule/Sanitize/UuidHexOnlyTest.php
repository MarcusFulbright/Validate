<?php

namespace Mbright\Validation\Tests\Rule\Sanitize;

class UuidHexOnlyTest extends AbstractSanitizeTest
{
    public function providerTo()
    {
        return [
            // sanitize passes
            [
                '12345678-90ab-cDef-1234-5678&&90123456',
                true,
                '1234567890abcDef1234567890123456'
            ],
            [
                '1234567890abcDef12345678&&90123456',
                true,
                '1234567890abcDef1234567890123456'
            ],
            [
                '1234#@5678-90ab-cdef-1234-5678&&90123456',
                true,
                '1234567890abcdef1234567890123456'
            ],


            // sanitize fails
            ['', false, ''],
            [
                '1234*&56789-0ab-cdef-1234-567890123456abc',
                false,
                '1234*&56789-0ab-cdef-1234-567890123456abc'
            ],

        ];
    }
}
