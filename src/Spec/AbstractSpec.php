<?php

namespace Mbright\Validation\Spec;

use Mbright\Validation\Exception\ValidationException;
use Mbright\Validation\Locator\AbstractLocator;

abstract class AbstractSpec
{
    /**
     * Failure Mode for a halting failure.
     *
     * @var string
     */
    const HALTING_FAILURE = 'HALTING_FAILURE';

    /**
     * Failure Mode for a hard failure.
     *
     * @var string
     */
    const HARD_FAILURE = 'HARD_FAILURE';

    /**
     * Failure Mode for a soft failure.
     *
     * @var string
     */
    const SOFT_FAILURE = 'SOFT_FAILURE';

    /**
     * Field name for the spec to operate on.
     *
     * @var string
     */
    protected $field;

    /**
     * Locator to fetch rules from.
     *
     * @var AbstractLocator
     */
    protected $locator;

    /**
     * Rule to invoke.
     *
     * @var callable
     */
    protected $rule;

    /**
     * Arguments supplied to the rule
     *
     * @var array
     */
    protected $args = [];

    /**
     * Failure message to be used instead of the default message.
     *
     * @var string
     */
    protected $message;

    /**
     * Name of the rule to execute.
     *
     * @var string
     */
    protected $ruleName;

    /**
     * Flag that determines the allowance of blank values.
     *
     * @var bool
     */
    protected $allowBlanks = false;

    /**
     * An array of values to be considered blank.
     *
     * @var array
     */
    protected $blankWhiteList = [];

    /**
     * AbstractSpec constructor.
     *
     * @param string $field
     * @param AbstractLocator $locator
     */
    public function __construct(string $field, AbstractLocator $locator)
    {
        $this->field = $field;
        $this->locator = $locator;
    }

    /**
     * Invokes the rule that this spec is configured for.
     *
     * @param object $subject
     *
     * @return bool
     */
    public function __invoke($subject): bool
    {
        return ($this->rule)($subject, $this->field, ...array_values($this->args));
    }

    /**
     * Set a custom message.
     *
     * @param string $message
     *
     * @return self
     */
    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Returns the field this spec applies to.
     *
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * Returns the failure message for this rule specification.
     *
     * @return string
     */
    public function getMessage(): string
    {
        if (!$this->message) {
            $this->message = $this->getDefaultMessage();
        }

        return $this->message;
    }

    /**
     * Returns the args this spec is configured to use.
     *
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * Returns the name of the rule that was ran.
     *
     * @return string
     */
    public function getRuleName(): string
    {
        return $this->ruleName;
    }

    /**
     * Sets the rule and ruleName for the spec.
     *
     * @param $ruleName
     *
     * @throws ValidationException
     *
     * @return AbstractSpec
     */
    public function setRule($ruleName): self
    {
        $this->rule = $this->locator->get($ruleName);
        $this->ruleName = $ruleName;

        return $this;
    }

    /**
     * Sets the white list of values that should be considered blank.
     *
     * @param array $blankWhiteList
     *
     * @return ValidateSpec
     */
    public function setBlankValues(array $blankWhiteList): self
    {
        $this->blankWhiteList = $blankWhiteList;

        return $this;
    }

    /**
     * Sets the rule to halt the entire validation process on the subject.
     *
     * @return AbstractSpec
     */
    public function asHaltingRule(): self
    {
        $this->failureMode = self::HALTING_FAILURE;

        return $this;
    }

    /**
     * Sets the rule to stop further rules from applying to the same field.
     *
     * @return AbstractSpec
     */
    public function asHardRule(): self
    {
        $this->failureMode = self::HARD_FAILURE;

        return $this;
    }

    /**
     * Sets the rule to allow other rules to operate on the same field.
     *
     * @return AbstractSpec
     */
    public function asSoftRule(): self
    {
        $this->failureMode = self::SOFT_FAILURE;

        return $this;
    }

    /**
     * Returns the current failure mode.
     *
     * @return string
     */
    public function getFailureMode(): string
    {
        return $this->failureMode;
    }

    /**
     * Determines if the field is a `valid` blank value.
     *
     * Values are considered blank if they are, not sent, null, or strings that trim down to nothing. integers, floats,
     * arrays, resources, objects, etc., are never considered blank. Even a value of `(int) 0` will *not* evaluate as
     * blank.
     * The optional second argument is used to supply an array of white listed items that should be considered blank.
     *
     * @param mixed $subject
     * @param array $blankWhiteList
     *
     * @return bool
     */
    public function subjectFieldIsBlank($subject): bool
    {
        foreach ($this->blankWhiteList as $item) {
            if ($subject->{$this->field} === $item) {
                return true;
            }
        }

        // not set, or null, means it is blank
        if (!isset($subject->{$this->field}) || $subject->{$this->field} === null) {
            return true;
        }

        // non-strings are not blank: int, float, object, array, resource, etc
        if (!is_string($subject->{$this->field})) {
            return false;
        }

        // strings that trim down to exactly nothing are blank
        return trim($subject->{$this->field}) === '';
    }

    /**
     * Returns the default failure message for this rule specification.
     *
     * @return string
     */
    protected function getDefaultMessage(): string
    {
        return $this->ruleName . $this->argsToString();
    }

    /**
     * Converts the args to a string.
     *
     * @return string
     */
    protected function argsToString(): string
    {
        if (!$this->args) {
            return '()';
        }

        return '(' . implode(', ', $this->args) . ')';
    }
}
