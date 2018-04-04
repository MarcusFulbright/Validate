<?php

namespace Nashphp\Validation\Spec;

use Nashphp\Validation\Exception\ValidationException;

class ValidateSpec extends AbstractSpec
{
    /**
     * Extra values to be considered as valid blanks.
     *
     * @var array
     */
    protected $extraBlankValues = [];

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
        if (!$this->subjectFieldIsBlank($subject, $this->extraBlankValues)) {
            $result = parent::__invoke($subject);

            return $this->negated? !$result : $result;
        }

        if (!$this->allowBlanks) {
            return false;
        }
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
     * Configures the spec to allow blank values with the option to pass in additional blank values.
     *
     * Any additional blank values provided will get checked *before* the default blank values get checked.
     *
     * @param array $allowedBlanks
     */
    public function allowBlank(array $additionalBlanks = [])
    {
        $this->allowBlanks = true;
        $this->additionalBlanks = $additionalBlanks;
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
