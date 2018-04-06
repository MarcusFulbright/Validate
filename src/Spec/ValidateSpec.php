<?php

namespace Nashphp\Validation\Spec;

use Nashphp\Validation\Exception\ValidationException;

class ValidateSpec extends AbstractSpec
{
    /**
     * Flag to indicate if the negated value of the rule should be returned.
     *
     * @var bool
     */
    protected $negated = false;

    /**
     * Invokes the rule that this spec is configured for.
     *
     * @param object $subject
     *
     * @return bool
     */
    public function __invoke($subject): bool
    {
        $isBlank = $this->subjectFieldIsBlank($subject, $this->blankWhiteList);

        if ($this->allowBlanks && $isBlank) {
            return true;
        }

        if (!$isBlank) {
            $result = parent::__invoke($subject);

            return $this->negated ? !$result : $result;
        }

        return false;
    }

    /**
     * Sets a validation rule and its arguments.
     *
     * @param string $ruleName
     * @param array ...$args
     *
     * @throws ValidationException
     *
     * @return self
     */
    public function is(string $ruleName, ...$args): self
    {
        $this->setRule($ruleName);
        $this->args = $args;

        return $this;
    }

    /**
     * Sets a negated validation rule and its arguments.
     *
     * @param string $ruleName
     * @param array ...$args
     *
     * @throws ValidationException
     *
     * @return AbstractSpec
     */
    public function isNot(string $ruleName, ...$args): self
    {
        $this->negated = true;
        $this->is($ruleName, ...$args);

        return $this;
    }

    /**
     * Allow blank values to pass validation.
     *
     * @param array $allowedBlanks
     *
     * @return ValidateSpec
     */
    public function allowBlank(): self
    {
        $this->allowBlanks = true;

        return $this;
    }

    /**
     * Indicates if the spec accepts blank values.
     *
     * @return bool
     */
    public function acceptBlanks(): bool
    {
        return $this->allowBlanks;
    }

    /**
     * Generates the default message for validation failure.
     *
     * @return string
     */
    protected function getDefaultMessage(): string
    {
        return "{$this->field} did not pass " . parent::getDefaultMessage();
    }
}
