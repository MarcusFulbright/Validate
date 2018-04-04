<?php

namespace Nashphp\Validation\Spec;

use Nashphp\Validation\Exception\ValidationException;
use Nashphp\Validation\Locator\AbstractLocator;

abstract class AbstractSpec
{
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
    protected function setRule($ruleName): self
    {
        $this->rule = $this->locator->get($ruleName);
        $this->ruleName = $ruleName;

        return $this;
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


    /**
     * Determines if the field is a `valid` blank value.
     *
     * Values are considered blank if they are, not sent, null, or strings that trim down to nothing. integers, floats,
     * arrays, resources, objects, etc., are never considered blank. Even a value of `(int) 0` will *not* evaluate as
     * blank.
     * The optional `$validBlanks` argument can be passed in to provide a list of additional values that should get
     * considered as blank. These values are evaluated *before* the default blank values.
     *
     * @param mixed $subject
     * @param array $validBlanks
     *
     * @return bool
     */
    protected function subjectFieldIsBlank($subject, array $validBlanks = []): bool
    {
        $field = $this->field;

        foreach ($validBlanks as $blank) {
            if ($field === $blank) {
                return false;
            }
        }

        // not set, or null, means it is blank
        if (! isset($subject->$field) || $subject->$field === null) {
            return true;
        }

        // non-strings are not blank: int, float, object, array, resource, etc
        if (! is_string($subject->$field)) {
            return false;
        }

        // strings that trim down to exactly nothing are blank
        return trim($subject->$field) === '';
    }
}
