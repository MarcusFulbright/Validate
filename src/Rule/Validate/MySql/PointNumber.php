<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\ValidateRuleInterface;

/**
 * Validates that data can be sent into one of the following column types:
 *  - Decimal
 *  - Numeric
 *  - Float
 *  - Double
 */
class PointNumber implements ValidateRuleInterface
{
    /**
     * Represents the precision of the float.
     *
     * @var int
     */
    protected $precision;

    /**
     * Represents the scale for the float which determines the range of accepted values.
     *
     * @var int
     */
    protected $scale;

    /**
     * @param int $precision
     * @param int $scale
     */
    public function __construct(int $precision = 10, int $scale = 0)
    {
        $this->precision = $precision;
        $this->scale = $scale;
    }

    /**
     * Check that the value in the given field is a valid fixed point with the appropriate precision and scale.
     *
     * @param object $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field;

        if (!is_float($value)) {
            return false;
        }

        // separate the digits based on if they come before or after the decimal
        $segments = explode('.', (string) $value);
        $numBeforeDecimal = count($segments[0]);
        $numAfterDecimal = count($segments[1] ?? []);

        return $this->checkPrecision($numBeforeDecimal, $numAfterDecimal) && $this->checkScale($numAfterDecimal);
    }

    /**
     * Ensures the correct precision.
     *
     * @param int $numBeforeDecimal
     * @param int $numAfterDecimal
     *
     * @return bool
     */
    protected function checkPrecision(int $numBeforeDecimal, int $numAfterDecimal)
    {
        return $numAfterDecimal + $numBeforeDecimal <= $this->precision;
    }

    /**
     * Ensures the correct scale.
     *
     * @param int $numAfterDecimal
     *
     * @return bool
     */
    protected function checkScale(int $numAfterDecimal)
    {
        return $numAfterDecimal <= $this->scale;
    }
}
