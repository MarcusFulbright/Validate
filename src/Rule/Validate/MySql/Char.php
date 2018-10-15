<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\Strlen;

/**
 * Validates that data can be inserted into one of the following column types:
 * - Char
 * - Binary
 */
class Char extends Strlen
{
    /**
     * @param int $len Acceptable character length
     */
    public function __construct(int $len)
    {
        if ($len < 0 || $len > 255) {
            throw new \InvalidArgumentException('Char can only accepts lengths between 0 and 255');
        }

        parent::__construct($len);
    }
}
