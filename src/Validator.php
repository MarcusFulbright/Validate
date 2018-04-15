<?php

namespace Nashphp\Validation;

use Nashphp\Validation\Exception\ValidationException;
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

    /** @var ValidateSpec[] */
    protected $validateSpecs = [];

    /** @var SanitizeSpec[] */
    protected $sanitizeSpecs = [];

    /**
     * Fields to skip during validation.
     *
     * @var array
     */
    protected $skip = [];

    /**
     * Messages to use for a field.
     *
     * Index is the fieldName, value is the message.
     *
     * @var array
     */
    protected $filedMessages = [];

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
        $this->init();
    }

    /**
     * Hook function that can be implemented in an extended custom validator class.
     *
     * If a custom class extends Validator, this method is the hook to provide some default rule configuration.
     */
    protected function init(): void
    {
        //do nothing
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
     *
     * @return ValidateSpec
     */
    public function validate(string $field): ValidateSpec
    {
        $spec = new ValidateSpec($field, $this->validationLocator);
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
     * @throws ValidationException
     *
     * @return SanitizeSpec
     */
    public function sanitize(string $field): SanitizeSpec
    {
        $spec = new SanitizeSpec($field, $this->sanitizeLocator);
        $this->sanitizeSpecs[] = $spec;

        return $spec;
    }

    /**
     * @param string $fieldName
     * @param string $message
     *
     * @return Validator
     */
    public function setFieldMessage(string $fieldName, string $message): self
    {
        $this->filedMessages[$fieldName] = $message;

        return $this;
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
        $continue = true;
        foreach ($this->sanitizeSpecs as $sanitizeSpec) {
            $continue = $this->applySpec($subject, $sanitizeSpec);
            if (!$continue) {
                break;
            }
        }

        if ($continue) {
            foreach ($this->validateSpecs as $validateSpec) {
                $continue = $this->applySpec($subject, $validateSpec);
                if (!$continue) {
                    break;
                }
            }
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
        if (in_array($spec->getField(), $this->skip)) {
            return true;
        }

        if ($spec($subject)) {
            return true;
        }

        $this->failSpec($spec);

        if ($spec->getFailureMode() === $spec::HALTING_FAILURE) {
            return false;
        }

        return true;
    }

    /**
     * Handles failing a spec.
     *
     * If the spec is set to a HardFailure, add its field to the skip list.
     *
     * @param AbstractSpec $spec
     */
    protected function failSpec(AbstractSpec $spec): void
    {
        $field = $spec->getField();

        if ($spec->getFailureMode() === $spec::HARD_FAILURE) {
            $this->skip[] = $field;
        }

        if (isset($this->filedMessages[$spec->getField()])) {
            $this->failures->set($field, $this->filedMessages[$field]);
        } else {
            $this->failures->add($field, $spec->getMessage(), $spec->getArgs());
        }
    }
}
