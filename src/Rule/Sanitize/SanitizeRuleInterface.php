<?php

namespace Mbright\Validation\Rule\Sanitize;

/**
 * This interface is for _all_ Sanitize rules including any custom rules.
 *
 * Sanitize rules _may_ manipulate the subject. They should only return a boolean that indicates if the field could be
 * successfully sanitized.
 */
interface SanitizeRuleInterface
{
    /**
     * @param object $subject The subject begin sanitized. Will always be an object
     * @param string $field The name of the field to be operated on
     *
     * @return bool Indicates success
     */
    public function __invoke($subject, string $field): bool;
}
