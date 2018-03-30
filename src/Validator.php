<?php

namespace Nashphp\Validation;

use Nashphp\Validation\Exception\NashPhpValidationException;
use Nashphp\Validation\Locator\SanitizeLocator;
use Nashphp\Validation\Locator\ValidationLocator;
use Nashphp\Validation\Spec\AbstractSpec;
use Nashphp\Validation\Spec\SanitizeSpec;
use Nashphp\Validation\Spec\ValidateSpec;
use Nashphp\Validation\Failure\FailureCollection;

class Validator
{
    /** @var ValidationLocator */
    protected $validationLocator;

    /** @var SanitizeLocator */
    protected $sanitizeLocator;

    /** @var FailureCollection */
    protected $failures;

    /**
     * The validate rules configured to be applied to a given subject.
     *
     * The keys represent the subject's property name and the value is an array of validation rules to apply.
     *
     * @var array
     */
    protected $validateSpecs = [];

    /**
     * The sanitize rules configured to be applied to a given subject.
     *
     * The keys represent the subject's property name and the value is an array of sanitize rules to apply.
     *
     * @var array
     */
    protected $sanitizeSpecs = [];

    /**
     * Validator constructor.
     *
     * @param ValidationLocator $validationLocator
     * @param SanitizeLocator $sanitizeLocator
     */
    public function __construct(
        ValidationLocator $validationLocator,
        SanitizeLocator $sanitizeLocator,
        FailureCollection $failureCollection
    ) {
        $this->validationLocator = $validationLocator;
        $this->sanitizeLocator = $sanitizeLocator;
        $this->failures = $failureCollection;
    }

    /**
     * Returns the collection of validation failures.
     *
     * @return FailureCollection
     */
    public function getFailures(): FailureCollection
    {
        return $this->failures;
    }

    /**
     * Configure the validator to validate the given $field, with the given $rule.
     *
     * @param string $field
     * @param string $ruleName
     * @param array $args
     *
     * @throws NashPhpValidationException
     *
     * @return ValidateSpec
     */
    public function validate(string $field, string $ruleName, array $args = []): ValidateSpec
    {
        $rule = $this->validationLocator->get($ruleName);
        $spec = new ValidateSpec($field, $rule, $ruleName, $args);
        $this->validateSpecs[] = $spec;

        return $spec;
    }

    /**
     * Configure the validator to sanitize the given $field, with the given $rule.
     *
     * @param string $field
     * @param string $ruleName
     * @param array $args
     *
     * @throws NashPhpValidationException
     *
     * @return SanitizeSpec
     */
    public function sanitize(string $field, string $ruleName, array $args = []): SanitizeSpec
    {
        $rule = $this->sanitizeLocator->get($ruleName);
        $spec = new SanitizeSpec($field, $rule, $ruleName, $args);
        $this->sanitizeSpecs[] = $spec;

        return $spec;
    }

    /**
     * Applies the configured validate and sanitize rules to the given $subject.
     *
     * @param array|object $subject
     *
     * @return bool
     */
    public function apply(&$subject): bool
    {
        if (is_array($subject)) {
            return $this->applyToArray($subject);
        }

        return $this->applyToObject($subject);
    }

    /**
     * Handles applying all rules to an array.
     *
     * The array gets type casted to an object then passed to `$this->applyToObject`. because this is all done by
     * reference, we can type cast it back to an array _after_ the `applyToObject()` call and return the $subject with
     * any values that many have been alerted by sanitize rules.
     *
     * @param array $subject
     *
     * @return bool
     */
    protected function applyToArray(array &$subject): bool
    {
        $object = (object) $subject;
        $result = $this->applyToObject($object);
        $subject = (array) $object;

        return $result;
    }

    /**
     * Applies all sanitize and validate specs to a given object.
     *
     * Sanitize specs run first
     *
     * @param $subject
     *
     * @return bool
     */
    protected function applyToObject($subject): bool
    {
        foreach ($this->sanitizeSpecs as $sanitizeSpec) {
            $this->applySpec($subject, $sanitizeSpec);
        }

        foreach ($this->validateSpecs as $validateSpec) {
            $this->applySpec($subject, $validateSpec);
        }

        return $this->failures->isEmpty();
    }

    /**
     * Applies a given spec to the subject.
     *
     * If the spec returns false, this will log the error.
     *
     * @param object $subject
     * @param AbstractSpec $spec
     *
     * @return bool
     */
    protected function applySpec($subject, AbstractSpec $spec): bool
    {
        if ($spec($subject)) {
            return true;
        }

        $this->failures->add($spec->getField(), $spec->getMessage(), $spec->getArgs());

        return false;
    }
}
