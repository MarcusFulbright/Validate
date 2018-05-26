## Documentation Index

* [Blank Values](/docs/BlankValues.md)
* [Custom Rules](/docs/CustomRules.md)
* [Validator Reuse](/docs/ValidateReuse.md)
* [Available Sanitize Rules](/docs/SanitizeRules.md)
* [Available Validate Rules](/docs/ValidateRules.md)

# Getting Started

## Basic Usage

> The `tests/Examples` directory is full of example code to demonstrate common use cases. Sometimes code is the best documentation :)

The `ValidatorFactory` provides the easiest way to get started. It can provide Validators that are ready for use.

```php
$factory = new ValidatorFactory();
$validator = $factory->newValidator();
``` 

From here you can add rules that you want the validator to run.

## Adding Rules

There are two types of rules that can be added to your $validator:

1. Sanitize Rules: That manipulate data into a known format or type. Example: converting `(int) 0` to `(bool) false`

2. Validate Rules: Determine if a value meets expectations, but does _not_ manipulate the value

> Note: Sanitize Rules always run before Validate Rules

### Adding Sanitize Rules

Sanitize rules can be added to the Validator like so:

```php
$validator->sanitize('fieldName')->to('ruleName');
```

### Adding Validate Rules

Validate rules can be used to confirm that field meets the rule's expectations, or that the field does _not_ meet the rule's expectations:

```php
//validate that a field is a boolean
$validator->validate('fieldName')->is('ruleName')

//validate that a field is *not* a boolean
$validator->validate('fieldName')->isNot('ruleName')
```

### Failure Modes

The following methods can be used fluently after calling `validate()` or `sanitize()` to set the rules failure mode:

* `asSoftRule()`: if the rule fails, the validator will continue to apply all subsequent rules. This is the default behavior for Validate Rules.

* `asHardRule()`: if the rule fails, do not perform any more operations on the same field, but continue processing other fields. This is the default behavior for Sanitize Rules.

* `asHaltingRule()`: if this rule fails, do not perform any more validation on the subject and halt.

### Failure Messages

There are two levels of error messages that can be customized:

#### 1. Rule Level Messages
Rule level messages correspond to each rule that failed to run successfully. These messages can be customized by calling `setMessage($message)` after calling either `sanitize()` or `validate()`.

Example: 
```php
$validator->sanitize('someField')->to('bool')->setMessage('this field must be a type that can get converted to a boolean');

$validator->validate('someField')->is('bool')->setMessage('this field did not successfully validate as a strict boolean value');
```

> Note: if a field has multiple rules, there can be one field level message for every rule

#### 2. Field Level Messages

Field level messages are used to describe a single message to be used for a field if _any_ rules do not pass.

Example:
```php
$validator->setFieldMessage('someField', 'This field must be a boolean or a type that can be cast to a boolean');
```

## Applying the Validator

Once you have a Validator configured with all your rules, you're ready to apply the validator:

```php
$subject = [
    'isPublished' => false;
];

$isValid = validator->apply($subject);

if (!$isValid) {
    $failures = $validationService->getFailures();
    var_dump($failures);
}
```
> Note: $validator->apply() will return a boolean to indicate success

## Working With Failures

After applying a Validator, any failures can be retrieved by calling `$validator->getFailures()`. This returns an instance of `FailureCollection`. The FailureCollection class implements _ArrayObject_ which means you can treat it like an array. Every failure will be represented in the collection with a `ValidationFailure` object. The ValidationFailure object has the following methods:

* getField(): string [returns the field the rule applies to]
* getMessage(): string [returns the failure message]
* getArgs(): array [returns any arguments there were passed to the rule]

These methods can get used in various combinations to create a custom error output.
