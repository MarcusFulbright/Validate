<?php

namespace Nashphp\Validation\Locator;

use Nashphp\Validation\Exception\ValidationException;

abstract class AbstractLocator
{
    /**
     * Factories to create rule objects.
     *
     * @var array
     *
     */
    protected $factories = [];

    /**
     * Rule object instances.
     *
     * @var array
     */
    protected $instances = [];

    /**
     * Returns an array of default factories for a locator to use.
     *
     * These key value pairs should have the rule name as the key, and a callable that returns a new instance of the
     * rule as the value.
     *
     * @return array
     */
    abstract protected function getDefaultFactories(): array;

    /**
     * Constructor.
     *
     * @param array $factories An array of key-value pairs where the key is the
     * rule name and the value is a callable that returns a rule object.
     */
    public function __construct(array $factories = [])
    {
        $mergedFactories = array_merge($factories, $this->getDefaultFactories());
        $this->initFactories($mergedFactories);
    }

    /**
     * Initialize the $factories property for the first time.
     *
     * @param array $factories An array of key-value pairs where the key is the
     * rule name and the value is a callable that returns a rule object.
     *
     * @return void
     */
    protected function initFactories(array $factories): void
    {
        foreach ($factories as $name => $spec) {
            $this->set($name, $spec);
        }
    }

    /**
     * Sets a rule factory by name.
     *
     * @param string $name The rule name.
     * @param callable $spec A callable that returns a rule.
     *
     * @return void
     */
    public function set($name, $rule): void
    {
        $this->factories[$name] = $rule;
        unset($this->instances[$name]);
    }

    /**
     * Gets a rule by name, whether an existing instance or from a factory.
     *
     * @param string $name The rule to retrieve.
     *
     * @throws ValidationException
     *
     * @return callable A callable rule.
     */
    public function get($name): callable
    {
        $mapped = isset($this->factories[$name]) || isset($this->instances[$name]);
        if (!$mapped) {
            throw ValidationException::ruleNotMappedException($name);
        }

        if (!isset($this->instances[$name])) {
            $this->instances[$name] = call_user_func($this->factories[$name]);
        }

        return $this->instances[$name];
    }
}
