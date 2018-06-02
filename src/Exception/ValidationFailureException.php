<?php

namespace Mbright\Validation\Exception;

use Mbright\Validation\Failure\FailureCollection;

class ValidationFailureException extends \Exception
{
    /**
     * Failures from the filter.
     *
     * @var FailureCollection
     */
    protected $failures;

    /**
     * The subject being filtered.
     *
     * @var mixed
     */
    protected $subject;

    /**
     * Sets the failures from the filter.
     *
     * @param FailureCollection $failures The filter failures.
     *
     * @return null
     */
    public function setFailures(FailureCollection $failures): void
    {
        $this->failures = $failures;
    }

    /**
     * Gets the failures from the filter.
     *
     * @return FailureCollection
     */
    public function getFailures(): FailureCollection
    {
        return $this->failures;
    }

    /**
     * Sets the subject of the filter.
     *
     * @param mixed $subject The subject being filtered.
     *
     * @return null
     */
    public function setSubject($subject): void
    {
        $this->subject = $subject;
    }

    /**
     * Gets the subject of the filter.
     *
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }
}
