<?php

namespace Mbright\Validation\Spec;

use Mbright\Validation\Exception\ValidationException;

class SanitizeSpec extends AbstractSpec
{
    /**
     * Value to use when inserting
     *
     * @var mixed
     */
    protected $blankValue;

    /**
     * Failure mode for the rule.
     *
     * @var string
     */
    protected $failureMode = 'HARD_FAILURE';

    /**
     * Invokes the rule the spec is configured for.
     *
     * @param object $subject
     *
     * @return bool
     */
    public function __invoke($subject): bool
    {
        if (!$this->subjectFieldIsBlank($subject)) {
            return parent::__invoke($subject);
        }

        if (!$this->allowBlanks) {
            return false;
        }

        $subject->{$this->field} = $this->blankValue;

        return true;
    }

    /**
     * Set the Sanitize rule to be used.
     *
     * @param string $ruleName*
     *
     * @throws ValidationException
     *
     * @return SanitizeSpec
     */
    public function to(string $ruleName): self
    {
        $this->setRule($ruleName);

        return $this;
    }

    /**
     * Sets the blank value to use.
     *
     * Defaults to null.
     *
     * @param $blankValue
     *
     * @return SanitizeSpec
     */
    public function usingBlank($blankValue = null): self
    {
        $this->allowBlanks = true;
        $this->blankValue = $blankValue;

        return $this;
    }

    /**
     * Returns the default failure message for this rule specification.
     *
     * @return string
     */
    protected function getDefaultMessage(): string
    {
        $message = $this->field . ' should have sanitized to ';

        if ($this->allowBlanks) {
            $message .= 'blank or ';
        }

        return "{$message}" . parent::getDefaultMessage();
    }
}
