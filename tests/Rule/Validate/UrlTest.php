<?php

namespace Mbright\Validation\Tests\Rule\Validate;

class UrlTest extends AbstractValidateTest
{
    public function providerIs()
    {
        return [
            ["http://example.com"],
            ["https://example.com/path/to/file.php"],
            ["ftp://example.com/path/to/file.php/info"],
            ["news://example.com/path/to/file.php/info?foo=bar&baz=dib#zim"],
            ["gopher://example.com/?foo=bar&baz=dib#zim"],
            ["mms://user:pass@site.info/path/to/file.php/info?foo=bar&baz=dib#zim"],
        ];
    }

    public function providerIsNot()
    {
        return [
            [[]],
            [''],
            [' '],
            ['example.com'],
            ['http://'],
            ["http://example.com\r/index.html"],
            ["http://example.com\n/index.html"],
            ["http://example.com\t/index.html"],
        ];
    }
}
