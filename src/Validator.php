<?php

namespace Mbright\Validation;

use Mbright\Validation\Exception\ValidationFailureException;
use Mbright\Validation\Spec\AbstractSpec;
use Mbright\Validation\Spec\SanitizeSpec;
use Mbright\Validation\Spec\ValidateSpec;
use Mbright\Validation\Failure\FailureCollection;

class Validator
{
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
     * @param FailureCollection $failureCollection
     */
    public function __construct(
        FailureCollection $failureCollection
    ) {
        $this->failures = $failureCollection;
        $this->init();
    }

    /**
     * Asserts the validator, throws a ValidationFailureException if anything fails
     *
     * @param $subject
     *
     * @throws ValidationFailureException
     *
     * @return bool
     */
    public function __invoke(&$subject): bool
    {
        return $this->assert($subject);
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
     * Configure the validator to validate the given $field, with the given $rule.
     *
     * @param string $field
     *
     * @return ValidateSpec
     */
    public function validate(string $field): ValidateSpec
    {
        $spec = new ValidateSpec($field);
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
     * @return SanitizeSpec
     */
    public function sanitize(string $field): SanitizeSpec
    {
        $spec = new SanitizeSpec($field);
        $this->sanitizeSpecs[] = $spec;

        return $spec;
    }

    /**
     * Applies the validator to the subject and throws an exception upon failure
     *
     * @param $subject
     *
     * @throws ValidationFailureException
     *
     * @return bool
     */
    public function assert(&$subject)
    {
        if ($this->apply($subject)) {
            return true;
        }

        $message = $this->failures->getMessagesAsString();
        $e = new ValidationFailureException($message);
        $e->setFailures($this->failures);
        $e->setSubject($subject);

        throw $e;
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
            $this->failures->add($field, $spec->getMessage(), $spec->getRuleClass(), $spec->getArgs());
        }
    }
}
