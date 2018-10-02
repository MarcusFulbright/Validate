<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\AbstractIntegerCase;

abstract class AbstractMySqlIntegerCase extends AbstractIntegerCase
{
    /**
     * Indicates if the integer is signed.
     *
     * @var bool
     */
    protected $signed;

    /**
     * @param bool $signed Indicates if the value is signed. For MySql 5.7, integers are signed by default.
     */
    public function __construct(bool $signed = true)
    {
        $this->signed = $signed;
    }

    /**
     * Return the minimum allowed Signed value.
     *
     * @return int|float
     */
    abstract protected function minSignedValue();

    /**
     * Return the maximum allowed Signed value.
     *
     * @return int|float
     */
    abstract protected function maxSignedValue();

    /**
     * Return the minimum allowed Unsigned value.
     *
     * @return int|float
     */
    abstract protected function minUnSignedValue();

    /**
     * Return the maximum allowed Unsigned value.
     *
     * @return int|float
     */
    abstract protected function maxUnsignedValue();

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

        return $this->isInteger($value) && $this->isWithinBounds($value);
    }

    /**
     * Indicates if the given value is within
     *
     * @param int $value
     *
     * @return bool
     */
    protected function isWithinBounds($value): bool
    {
        if ($this->signed) {
            return $value >= $this->minSignedValue() && $value <= $this->maxSignedValue();
        }

        return $value >= $this->minUnSignedValue() && $value <= $this->maxUnsignedValue();
    }
}
