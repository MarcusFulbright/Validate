<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\ValidateRuleInterface;

/**
 * Validates that data can be inserted into one of the following column types:
 * - INT
 */
class StandardInt extends AbstractMySqlIntegerCase implements ValidateRuleInterface
{
    /**
     * {@inheritdoc}
     */
    protected function minSignedValue()
    {
        return -2147483648;
    }

    /**
     * {@inheritdoc}
     */
    protected function maxSignedValue()
    {
        return 2147483647;
    }

    /**
     * {@inheritdoc}
     */
    protected function maxUnsignedValue()
    {
        return 4294967295;
    }

    /**
     * {@inheritdoc}
     */
    protected function minUnSignedValue()
    {
        return 0;
    }
}
