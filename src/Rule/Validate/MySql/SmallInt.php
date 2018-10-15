<?php

namespace Mbright\Validation\Rule\Validate\MySql;

/**
 * Validates that data can be inserted into one of the following column types:
 * - SmallInt
 */
class SmallInt extends AbstractMySqlIntegerCase
{
    /**
     * {@inheritdoc}
     */
    protected function minSignedValue()
    {
        return -32768;
    }

    /**
     * {@inheritdoc}
     */
    protected function maxSignedValue()
    {
        return 32767;
    }

    /**
     * {@inheritdoc}
     */
    protected function maxUnsignedValue()
    {
        return 65535;
    }

    /**
     * {@inheritdoc}
     */
    protected function minUnSignedValue()
    {
        return 0;
    }
}
