<?php

namespace Mbright\Validation\Failure;

class FailureCollection extends \ArrayObject
{
    /**
     * Factory method to return a new Failure object.
     *
     * @param string $field The field that failed
     * @param string $message The failure message
     * @param string $ruleClass Class for the rule that failed
     * @param array $args The arguments passed to the rule specification
     *
     * @return ValidationFailure
     */
    protected function newFailure(
        string $field,
        string $message,
        ?string $ruleClass = null,
        array $args = []
    ): ValidationFailure {
        return new ValidationFailure($field, $message, $ruleClass, $args);
    }

    /**
     * Returns bool indicating if the array is empty.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        return count($this) === 0;
    }

    /**
     * Set a failure on a field, removing all previous failures.
     *
     * @param string $field The field that failed
     * @param string $message The failure message
     * @param array $args The arguments passed to the rule specification
     *
     * @return ValidationFailure
     */
    public function set(string $field, string $message, array $args = []): ValidationFailure
    {
        $failure = $this->newFailure($field, $message, null, $args);
        $this[$field] = [$failure];

        return $failure;
    }

    /**
     * Adds an additional failure on a field.
     *
     * @param string $field The field that failed
     * @param string $message The failure message
     * @param string $ruleClass Class for the rule that failed
     * @param array $args The arguments passed to the rule specification
     *
     * @return ValidationFailure
     */
    public function add(string $field, string $message, string $ruleClass, array $args = []): ValidationFailure
    {
        $failure = $this->newFailure($field, $message, $ruleClass, $args);
        $this[$field][] = $failure;

        return $failure;
    }

    /**
     * Returns all failures for a field.
     *
     * @param string $field The field name
     *
     * @return array
     */
    public function forField(string $field): array
    {
        if (!isset($this[$field])) {
            return [];
        }

        return $this[$field];
    }

    /**
     * Returns all failure messages for all fields.
     *
     * @return array
     */
    public function getMessages(): array
    {
        $messages = [];
        foreach ($this as $field => $failures) {
            $messages[$field] = $this->getMessagesForField($field);
        }

        return $messages;
    }

    /**
     * Returns all failure messages for one field.
     *
     * @param string $field The field name
     *
     * @return array
     */
    public function getMessagesForField(string $field): array
    {
        if (!isset($this[$field])) {
            return [];
        }
        $messages = [];

        /** @var ValidationFailure $failure */
        foreach ($this[$field] as $failure) {
            $messages[] = $failure->getMessage();
        }

        return $messages;
    }

    /**
     * Returns a single string of all failure messages for all fields.
     *
     * @param string $prefix Prefix each line with this string
     *
     * @return string
     */
    public function getMessagesAsString($prefix = ''): string
    {
        $string = '';
        foreach ($this as $field => $failures) {
            /** @var ValidationFailure $failure */
            foreach ($failures as $failure) {
                $message = $failure->getMessage();
                $string .= "{$prefix}{$field}: {$message}" . PHP_EOL;
            }
        }
        return $string;
    }

    /**
     * Returns a single string of all failure messages for one field.
     *
     * @param string $field The field name
     * @param string $prefix Prefix each line with this string
     *
     * @return string
     */
    public function getMessagesForFieldAsstring($field, $prefix = ''): string
    {
        $string = '';
        foreach ($this->forField($field) as $failure) {
            $message = $failure->getMessage();
            $string .= "{$prefix}{$message}" . PHP_EOL;
        }
        return $string;
    }
}
