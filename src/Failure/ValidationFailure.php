<?php

namespace Mbright\Validation\Failure;

class ValidationFailure implements \JsonSerializable
{
    /** @var string */
    protected $field;

    /** @var string */
    protected $message;

    /** @var string */
    protected $ruleClass;

    /** @var array */
    protected $args;

    /**
     * ValidationFailure constructor.
     *
     * @param string $field
     * @param string $message
     * @param string $ruleClass
     * @param array $args
     */
    public function __construct(string $field, string $message, ?string $ruleClass = null, array $args = [])
    {
        $this->field = $field;
        $this->message = $message;
        $this->ruleClass = $ruleClass;
        $this->args = $args;
    }

    /**
     * @return string
     */
    public function getField(): string
    {
        return $this->field;
    }

    /**
     * @return string
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getRuleClass(): string
    {
        return $this->ruleClass;
    }

    /**
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * Returns array for json_encode.
     *
     * @return array
     */
    public function jsonSerialize(): array
    {
        return [
            'field' => $this->field,
            'message' => $this->message,
            'ruleClass' => $this->ruleClass,
            'args' => $this->args
        ];
    }
}
