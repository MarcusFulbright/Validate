<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\AbstractIntegerCase;
use Mbright\Validation\Rule\Validate\ValidateRuleInterface;

/**
 * Validates that data can be inserted into one of the following column types:
 * - BIT
 */
class BitValue extends AbstractIntegerCase implements ValidateRuleInterface
{
    /** @var int */
    protected $size;

    public function __construct(int $size)
    {
        if ($size < 1 || $size > 64) {
            throw new \InvalidArgumentException('Mysql Bit columns can only accept a size between 1 and 64');
        }

        $this->size = $size;
    }

    /**
     * Validates that the given field has an integer value that can be expressed in the appropriate number of bits.
     *
     * @param object $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;
        $isInteger = $this->isInteger($value);
        $size = (int)(log($value) / log(2)) + 1;

        return $isInteger && $size <= $this->size;
    }
}
