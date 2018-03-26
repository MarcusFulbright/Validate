<?php

namespace Nashphp\Validation\Failure;

class ValidationFailure implements \JsonSerializable
{
    /** @var string */
    protected $field;

    /** @var string */
    protected $message;

    /** @var array */
    protected $args;

    /**
     * ValidationFailure constructor.
     *
     * @param string $field
     * @param string $message
     * @param array $args
     */
    public function __construct(string $field, string $message, array $args)
    {
        $this->field = $field;
        $this->message = $message;
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
            'args' => $this->args
        ];
    }
}
