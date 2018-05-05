<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class EmailTest extends AbstractValidateTest
{
    public function providerIs()
    {
        $xml = simplexml_load_file(__DIR__ . DIRECTORY_SEPARATOR . 'EmailTest.xml');
        $provide = [];
        foreach ($xml->test as $test) {
            if ($this->isValidAddressRegardlessOfDns($test)) {
                $this->appendToProvide($provide, $test);
            }
        }

        return $provide;
    }

    public function providerIsNot()
    {
        $xml = simplexml_load_file(__DIR__ . DIRECTORY_SEPARATOR . 'EmailTest.xml');
        $provide = [];
        foreach ($xml->test as $test) {
            if (! $this->isValidAddressRegardlessOfDns($test)) {
                $this->appendToProvide($provide, $test);
            }
        }
        return $provide;
    }

    protected function isValidAddressRegardlessOfDns($test)
    {
        return $test->diagnosis == 'ISEMAIL_VALID'
            || $test->diagnosis == 'ISEMAIL_RFC5321_IPV6DEPRECATED'
            || $test->category == 'ISEMAIL_RFC5321'
            || $test->category == 'ISEMAIL_DNSWARN';
    }

    protected function appendToProvide(&$provide, $test)
    {
        $provide[(string) $test['id']] = [
            $this->convertSymbolsToControls((string) $test->address)
        ];
    }

    /**
     * The XML test file uses text symbol strings to represent ASCII control
     * codes. This converts the text symbols to the actual control characters.
     */
    protected function convertSymbolsToControls($address)
    {
        // &#x2407; => BEL 7 ␇
        // &#x2409; => HT 9  ␉
        // &#x240A; => LF 10 ␊
        // &#x240D; => CR 13 ␍
        return str_replace(
            ['␇', '␉', '␊', '␍'],
            [chr(7), chr(9), chr(10), chr(13)],
            $address
        );
    }

    public function testIDN()
    {
        if (!extension_loaded('intl')) {
            $this->markTestSkipped('The Intl extension is not available');
        }

        // add IDN addresses here so we don't pollute the original XML file.
        // addresses courtesy of David Grudl.
        $idn = [
            'test@háčkyčárky.cz',
            'test@example.укр'
        ];

        foreach ($idn as $value) {
            $this->assertTrue($this->invoke($value));
        }
    }
}
