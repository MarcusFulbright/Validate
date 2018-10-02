<?php

namespace Mbright\Validation\Rule\Validate\MySql;

/**
 * Validates that data can be inserted into one of the following column types:
 * - TINYINT
 */
class TinyInt extends AbstractMySqlIntegerCase
{
    /**
     * {@inheritdoc}
     */
    protected function minSignedValue()
    {
        return -128;
    }

    /**
     * {@inheritdoc}
     */
    protected function maxSignedValue()
    {
        return 127;
    }

    /**
     * {@inheritdoc}
     */
    protected function maxUnsignedValue()
    {
        return 255;
    }

    /**
     * {@inheritdoc}
     */
    protected function minUnSignedValue()
    {
        return 0;
    }
}
