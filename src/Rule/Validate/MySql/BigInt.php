<?php

namespace Mbright\Validation\Rule\Validate\MySql;

/**
 * Validates that data can be inserted into one of the following column types:
 * - BigInt
 */
class BigInt extends AbstractMySqlIntegerCase
{
    /**
     * {@inheritdoc}
     */
    protected function minSignedValue()
    {
        return -pow(2, 63);
    }

    /**
     * {@inheritdoc}
     */
    protected function maxSignedValue()
    {
        return pow(2, 63) - 1;
    }

    /**
     * {@inheritdoc}
     */
    protected function maxUnsignedValue()
    {
        return pow(2, 64) - 1;
    }

    /**
     * {@inheritdoc}
     */
    protected function minUnSignedValue()
    {
        return 0;
    }

    /**
     * Ensures that the field's value is a valid Mysql standard int.
     *
     * @param object $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        return $this->isNumeric($value) && $this->isWithinBounds($value);
    }
}
