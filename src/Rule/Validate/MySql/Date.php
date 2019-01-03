<?php

namespace Mbright\Validation\Rule\Validate\MySql;

use Mbright\Validation\Rule\Validate\ValidateRuleInterface;

/**
 * Validates that data can be inserted into one of the following column types:
 * - Date
 */
class Date implements ValidateRuleInterface
{
    use DateTypeTrait;

    protected $delimiterPattern = '[^[:punct:]]';

    /**
     * Returns a bool indicating if the value can be safely stored in a MySql Date column.
     *
     * @param object $subject
     * @param string $field
     *
     * @return bool
     */
    public function __invoke($subject, string $field): bool
    {
        $value = (string) $subject->$field;
        $dateParts = $this->extractDateParts($value, $this->delimiterPattern, true);

        return !is_null($dateParts) && checkdate($dateParts->month, $dateParts->day, $dateParts->year);
    }
}
