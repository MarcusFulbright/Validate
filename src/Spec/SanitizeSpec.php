<?php

namespace Nashphp\Validation\Spec;

use Nashphp\Validation\Exception\ValidationException;

class SanitizeSpec extends AbstractSpec
{
    /**
     * Value to use when inserting
     *
     * @var mixed
     */
    protected $blankValue;

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
     * @param string $ruleName*
     *
     * @throws ValidationException
     *
     * @return self
     */
    public function to(string $ruleName): self
    {
        $this->setRule($ruleName);

        return $this;
    }

    public function usingBlank($blankValue)
    {
        $this->allowBlanks = true;
        $this->blankValue = $blankValue;
    }
}
