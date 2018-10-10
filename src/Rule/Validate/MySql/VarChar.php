<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\Strlen;

/**
 * Validates that data can be inserted into one of the following column types:
 * - Varchar
 * - Varbinary
 */
class VarChar extends Strlen
{
    public function __construct(int $len)
    {
        if ($len > 65535 || $len < 0) {
            throw new \InvalidArgumentException('Varchar can only accept lenghts between 0 and 65535');
        }

        parent::__construct($len);
    }
}
