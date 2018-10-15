<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\Strlen;

/**
 * Validates that data can be inserted into one of the following column types:
 * - MediumBlob
 * - MediumText
 */
class MediumBlob extends Strlen
{
    /**
     * @param int $len Acceptable string length.
     */
    public function __construct(int $len)
    {
        if ($len < 0 || $len > (pow(2, 24))) {
            throw new \InvalidArgumentException('Medium Blob & Text can only accept lengths between 0 - 2^16');
        }

        parent::__construct($len);
    }
}
