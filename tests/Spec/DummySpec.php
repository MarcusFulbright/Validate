<?php

namespace Mbright\Validation\Tests\Spec;

use Mbright\Validation\Spec\AbstractSpec;

/**
 * This is a dummy class used for testing methods on AbstractSpec
 */
class DummySpec extends AbstractSpec
{
    public function addRuleMock($rule)
    {
        $this->rule = $rule;
    }

    public function addArgs($args)
    {
        $this->args = $args;
    }

    public function addRuleName($ruleName)
    {
        $this->ruleName = $ruleName;
    }
}
