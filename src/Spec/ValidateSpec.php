<?php

namespace Mbright\Validation\Spec;

use Mbright\Validation\Rule\Validate\ValidateRuleInterface;

class ValidateSpec extends AbstractSpec
{
    /**
     * Flag to indicate if the negated value of the rule should be returned.
     *
     * @var bool
     */
    protected $negated = false;

    /**
     * Failure mode for the rule.
     *
     * @var string
     */
    protected $failureMode = 'SOFT_FAILURE';

    /**
     * Invokes the rule that this spec is configured for.
     *
     * @param object $subject
     *
     * @return bool
     */
    public function __invoke($subject): bool
    {
        $isBlank = $this->subjectFieldIsBlank($subject);

        if ($isBlank && $this->allowBlanks) {
            return true;
        }

        if ($isBlank && !$this->allowBlanks) {
            return false;
        }

        $result = parent::__invoke($subject);

        return $this->negated ? !$result : $result;
    }

    /**
     * Sets a validation rule and its arguments.
     *
     * @param ValidateRuleInterface $rule
     *
     * @return self
     */
    public function is(ValidateRuleInterface $rule): self
    {
        $this->rule = $rule;
        $this->ruleClass = get_class($rule);

        return $this;
    }

    /**
     * Sets a negated validation rule and its arguments.
     *
     * @param ValidateRuleInterface $ruleClass
     *
     * @return AbstractSpec
     */
    public function isNot(ValidateRuleInterface $rule): self
    {
        $this->negated = true;
        $this->is($rule);

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
     * Returns the default failure message for this rule specification.
     *
     * @return string
     */
    protected function getDefaultMessage(): string
    {
        $message = $this->field . ' should';
        if (!$this->allowBlanks) {
            $message .= ' not be blank and';
        }

        if ($this->allowBlanks) {
            $message .= ' have been blank or';
        }

        if ($this->negated) {
            $message .= ' not';
        }

        return "{$message} validated as " . parent::getDefaultMessage();
    }
}
