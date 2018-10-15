<?php

namespace Mbright\Validation\Rule\Validate\MySql;

/**
 * Validates that data can be inserted into one of the following column types:
 * - MediumInt
 */
class MediumInt extends AbstractMySqlIntegerCase
{
    /**
     * {@inheritdoc}
     */
    protected function minSignedValue()
    {
        return -8388608;
    }

    /**
     * {@inheritdoc}
     */
    protected function maxSignedValue()
    {
        return 8388607;
    }

    /**
     * {@inheritdoc}
     */
    protected function maxUnsignedValue()
    {
        return 16777215;
    }

    /**
     * {@inheritdoc}
     */
    protected function minUnSignedValue()
    {
        return 0;
    }
}
