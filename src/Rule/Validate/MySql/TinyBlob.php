<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\Strlen;

/**
 * Validates that data can be inserted into one of the following column types:
 * - TinyBlob
 * - TinyText
 */
class TinyBlob extends Strlen
{
    public function __construct(int $len)
    {
        if ($len < 0 || $len > (pow(2, 8))) {
            throw new \InvalidArgumentException('TinyBlob & Text can only accept lengths between 0 - 2^8');
        }

        parent::__construct($len);
    }
}
