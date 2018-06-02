<?php

namespace Mbright\Validation;

use Mbright\Validation\Failure\FailureCollection;

class ValidatorFactory
{
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
            $this->newFailureCollection()
        );
    }
}
