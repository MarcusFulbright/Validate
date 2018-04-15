<?php

namespace Mbright\Validation;

use Mbright\Validation\Failure\FailureCollection;
use Mbright\Validation\Locator\SanitizeLocator;
use Mbright\Validation\Locator\ValidationLocator;

class ValidatorFactory
{
    /** @var array */
    protected $customValidate;

    /** @var array */
    protected $customSanitize;

    /**
     * ValidatorFactory constructor.
     *
     * Custom sanitize or validate rules can get injected to this factory. The key for each array needs to be the 'name'
     * of the rule and the value should be a callable that will return an instance of the rule. Example:
     * ['my_custom_validate' => function() {return new MyCustomRule()};]
     *
     * @param array $customValidate
     * @param array $customSanitize
     */
    public function __construct(array $customValidate = [], array $customSanitize = [])
    {
        $this->customValidate = $customValidate;
        $this->customSanitize = $customSanitize;
    }

    /**
     * Get a new ValidationLocator and inject custom rules.
     *
     * @return ValidationLocator
     */
    public function newValidationLocator(): ValidationLocator
    {
        return new ValidationLocator($this->customValidate);
    }

    /**
     * Get a new Sanitize Locator and inject custom rules.
     *
     * @return SanitizeLocator
     */
    public function newSanitizeLocator(): SanitizeLocator
    {
        return new SanitizeLocator($this->customSanitize);
    }

    /**
     * Get a new Failure Collection.
     *
     * @return FailureCollection
     */
    public function newFailureCollection(): FailureCollection
    {
        return new FailureCollection();
    }

    /**
     * Get a new Validator that's ready to use.
     *
     * @return Validator
     */
    public function newValidator(): Validator
    {
        return new Validator(
            $this->newValidationLocator(),
            $this->newSanitizeLocator(),
            $this->newFailureCollection()
        );
    }
}
