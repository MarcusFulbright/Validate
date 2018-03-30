# PHP-Validation

**NashPhp\Validation** is a dead simple standalone validation library for PHP that is inspired by [Aura.Filter](). It has no dependencies, relies on PHP 7.0+, and can be used in any project.

## Goals

* Make validation easy for everyone
* Provide a solution that is truly framework agnostic
* Easily inject custom validation rules
* Easily control validation error messages

## Installation

This package will be made available to install via composer and packagist when it hits `0.1`

## Common Vocabulary

This library uses the following terms:

* Sanitize: The process of manipulating data into a known format or type. Example: converting `(int) 0` to `(bool) false`

* Validate: Determine if a value meets expectations, but do _not_ manipulate the value

The act of _Validating_ an object means execution a series of Sanitize Rules and Validate rules against the object. 
> Note: Sanitize Rules always run before Validate Rules

## Basic Usage

The `ValidatorFactory` provides the easiest way to get started. It can provide Validators that are ready for use.

```php
$factory = new ValidationServiceFactory();
$service = $factory->newValidationService();
``` 
> The `tests/Examples` directory is full of example code to demonstrate common use cases. Sometimes code is the best documentation :)

## Validating Objects

The Validator can validate objects and arrays by specifying what sanatize and validate rules to apply to each property (referred to as 'field' from here on).

### Rules

Once you've got a Validator, you can add Validate and Sanitize rules to it:

```php
// Ensure that a field is a boolean
$validationService->sanitize('isPublished', 'toBool');
$validationService->validate('isPublished', 'isBool');
```
> both `sanitize()` and `validate()` take the same arguments in the same order: string $fieldName, string $ruleName. The 3rd argument is an optional array of any arguments that a rule may require

Multiple sanitize and validate rules can operate on the same field. 

#### Custom Validation Messages

Every rule can also get configured to use a custom validation message:

```php
$validationService->validate('isPublished', 'isBool')->setMessage('the field [isPublished] must be a boolean]);
```

### Applying the Validator

Once you have a Validator configured with all your rules:

```php
$subject = [
    'isPublished' => false;
];

$isValid = $validationService->apply($subject);

if (!$isValid) {
    $failures = $validationService->getFailures();
    var_dump($failures);
}
```

Any failures can get retrieved by calling `Validator::getFailures()`. This returns an instance of `FailureCollection`. The FailureCollection class implements _ArrayObject_ which means you can treat it like an array. Every failure will be represented in the collection with a `ValidationFailure` object. The ValidationFailure object has the following methods:

* getField(): string [returns the field the rule applies to]
* getMessage(): string [returns the failure message]
* getArgs(): array [returns any arguments there were passed to the rule]

These methods can get used in various combinations to create a custom error output.


## Supported Sanitize Rules

The following rule names can be passed as the 2nd argument to `Validator::sanitize()`

#### toBool 
Applies the native `(bool)` typecast


## Supported Validate Rules

The following rule names can be passed as the 2nd argument to `Validator::validate()`

#### isBool
Applies the native `is_bool()` function
