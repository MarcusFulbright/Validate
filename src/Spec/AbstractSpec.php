<?php

namespace Nashphp\Validation\Spec;

abstract class AbstractSpec
{
    /** @var string */
    protected $field;

    /** @var callable */
    protected $rule;

    /** @var array */
    protected $args;

    /** @var string */
    protected $message;

    /** @var string */
    protected $ruleName;

    /**
     * AbstractSpec constructor.
     *
     * @param string $field
     * @param callable $rule
     * @param string $ruleName
     * @param array $args
     * @param string $message
     */
    public function __construct(string $field, callable $rule, string $ruleName, array $args)
    {
        $this->field = $field;
        $this->rule = $rule;
        $this->args = $args;
        $this->ruleName = $ruleName;
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
        array_unshift($this->args, $this->field);
        array_unshift($this->args, $subject);
        
        return call_user_func_array($this->rule, $this->args);
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
        if (! $this->args) {
            return '';
        }
        $vals = array();
        foreach ($this->args as $arg) {
            $vals[] = $this->argToString($arg);
        }

        return '(' . implode(', ', $vals) . ')';
    }

    /**
     * Converts one arg to a string.
     *
     * @param mixed $arg The arg.
     *
     * @return string
     */
    protected function argToString($arg): string
    {
        switch (true) {
            case $arg instanceof \Closure:
                return '*Closure*';
            case is_object($arg):
                return '*' . get_class($arg) . '*';
            case is_array($arg):
                return '*array*';
            case is_resource($arg):
                return '*resource*';
            case is_null($arg):
                return '*null*';
            default:
                return $arg;
        }
    }
}
