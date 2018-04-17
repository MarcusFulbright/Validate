# PHP-Validation

[![Build Status](https://travis-ci.org/MarcusFulbright/Validate.svg?branch=master)](https://travis-ci.org/MarcusFulbright/Validate)

**Mbright\Validation** is a dead simple standalone validation library for PHP that is inspired by [Aura.Filter](). It has no dependencies, relies on PHP 7.1+, and can be used in any project.

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

The act of _Validating_ an object means execution of a series of Sanitize rules and Validate rules against the object. 
> Note: Sanitize Rules always run before Validate Rules

## Basic Usage

The `ValidatorFactory` provides the easiest way to get started. It can provide Validators that are ready for use.

```php
$factory = new ValidationServiceFactory();
$service = $factory->newValidationService();
``` 
> The `tests/Examples` directory is full of example code to demonstrate common use cases. Sometimes code is the best documentation :)

## Validating Objects

The Validator can validate and sanitize objects and arrays by specifying what sanitize and validate rules to apply to each property (referred to as 'field' from here on).

### Rules

Once you've got a Validator, you can add Validate and Sanitize rules to it:

```php
// Ensure that a field is a boolean
$validationService->sanitize('isPublished')->to('bool');
$validationService->validate('isPublished')->is('bool');
```

Multiple Validation and Sanitize rules can apply to the same field. Sanitize rules are ran before Validate rules. Within each group, the rules are ran in the order they are defined.

### Applying the Validator

Once you have a Validator configured with all your rules:

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

Any failures can get retrieved by calling `Validator::getFailures()`. This returns an instance of `FailureCollection`. The FailureCollection class implements _ArrayObject_ which means you can treat it like an array. Every failure will be represented in the collection with a `ValidationFailure` object. The ValidationFailure object has the following methods:

* getField(): string [returns the field the rule applies to]
* getMessage(): string [returns the failure message]
* getArgs(): array [returns any arguments there were passed to the rule]

These methods can get used in various combinations to create a custom error output.

## Sanitize
After calling `Validator::sanitize('fieldName')`, a fluent interface provides several methods to configure the desired behavior:

* `to('ruleName')`: sanitizes a field to a given format using the given rule
> A complete list of all sanitize rules can be found below
* `useingBlank($blankValue)`: A blank value to use if a field cannot be sanitized   
* `setMessage('message)`: Set a custom message to use if the sanitize rule fails

Example:

```php
//Sanitize a field to a boolean or fail
$validator->sanitize('someField')->to('bool')

//Sanitize a field to a boolean, or set it to false
$validator->sanitize('someField')->to('bool')->usingBlank(false)

//Sanitize a field to a boolean with a custom failure message
$validator->sanitize('someField')->to('bool)->setMessage('Could not sanitize [someField] to a boolean value')
```

## Validate
After calling `Validator::validate('fieldName)`, a fluent interface provides several methods to configured the desired validation behavior:

* `is('ruleName)`: validates that field passes the given validation rule
> A complete list of all validate rules can be found below
* `isNot('ruleName)`: effectively negates the given thus ensuring that a field does _not_ pass the given rule
* `setMessage('message)`: sets the message to use when this rule fails for the given field 
* `allowBlanks()`: allows blank values without running the validation rule
*`setBlankValues($whiteList)`: Accepts an array of values that should be treated as blank values. These values will override default behavior.

## On Blank values:
This library does not rely on a simple `isset()` or `empty()` check to determine if a field is blank. A field is blank if: 
* it is not set
* it is set to null
* it is an empty string
* a string composed only of white space

This means that by default things like the following values are *not* considered blank by default:
* (int) 0
* (float) 0.00
* (bool) false
* []
* new \stdClass()

After calling `validate` *or* `sanitize` the method `setBlankValues($whiteList)` can be called to set a white list of values that should get treated as blanks. These values will override default behavior.

```php
$whiteList = [
  0,
  false
];
$validator->validate('field')->setBlankValues($whiteList);
$validator->sanitize('field')->setBlankValues($whiteList);
```

**Validation Example**
```php
//validate that a field is a boolean
$validator->validate('fieldName')->is('bool)

//validate that a field is *not* a boolean
$validator->validate('fieldName')->isNot('bool')

//validate that a field is a boolean and set a custom message
$validator->validate('fieldName')->is('bool')->setMessage('[fieldname] Must Be A Boolean') 

//validate that a field is a boolean or blank and specify that (int)0 is a valid blank value
$validator->validate('fieldName')->is('bool')->allowBlanks()->setBlanks([0])

//validate that a field is an integer, but prevent `(int) 0`
$validator->validate('fieldName')->is('int')->setBlankValues([0])
```

## Failure Modes

The following methods can be used fluently after calling `validate()` or `sanitize()` to se the rules failure mode:

* `asSoftRule()`: if the rule fails, the validator will continue to apply all subsequent rules. This is the default behavior for Validate Rules.

* `asHardRule()`: if the rule fails, do not perform any more operations on the same field. This is the default behavior for Sanitize Rules.

* `asHaltingRule()`: if this rule fails, do not perform any more validation on the subject and halt, returning any errors that have occurred up to this point.

## Field Level Messages

A _Field Message_ is used when _any_ rules fail on that field instead of displaying messages for each rule that failed.

```php
$validator->setFieldMessage('fieldName', 'custom message');
```

## Rules

### Sanitize Rules

The following rules can all be supplied to the `to()` function:

#### alphaNum
Strips all non alpha-numeric characters
```php
$validator->sanitize('field')->to('alphaNum');
```

#### alpha
Strips all non-alpha characters
```php
$validator->sanitize('field')->to('alpha');
```

#### between(min, max)
If the value is less than the given min, set it to the min. If it is over the given max, set it to the max.
```php
$validator->sanitize('field')->to('between', 5, 10);
```

#### bool 
Applies the native `(bool)` typecast
```php
$validator->sanitize('field')->to('bool');
```

#### callback
Sanitizes using a given callable.
```php
$callable = function ($subject, string $field) { $subject->$field = 'foo';};
$validator->sanitize('field')->to('callback', $callable);
```
> Note, the callable must have its first argument be the $subject and the 2nd argument must be a string representation of the field name under validation. Extra arguments may be passed after these two

#### dateTime(format)
Converts the given field to a dateTime of the given format.
```php
$validator->sanitize('field')->to('dateTime', 'Y-m-d H:i:s')
```
> Defaults to the format `Y-m-d H:i:s`


### int
Applies the native `(int)` typecast


### Validate Rules

The following rule names can be passed as the 2nd argument to `Validator::validate()`

#### bool
Applies the native `is_bool()` function
```php
$validator->validate('field')->is('bool');
```

#### alphaNum
Only allows alpha-numeric characters
```php
$validator->validate('field')->is('alphaNum');
```

#### alpha
Only allows alphabetic characters
```php
$validator->validate('field')->is('alpha');
```

#### alphaDash
Accepts alpha-numeric characters, underscores, and dashes
```php
$validator->validate('field')->is('alphaDash');
```

#### isBetween(min, max)
Checks that a value is between the given minimum and maximum values
```php
$validator->validate('field')->is('between', 5, 10);
```

## Extending The Validator Class
It may be helpful to have a custom Validator class that knows how to configure itself to validate a specific object or data set. You can do so by overriding the `init()` method:

```php
class CustomValidator extends Validator
{
    protected function init()
    {
        $this->sanitize('field')->to('rule');
        $this->validate('field')->is('rule');
        $this->useFieldMessage('field', 'message');
    }
}
```

## Custom Rules
Defining your own rules is very easy. Weather your custom rule is a Sanitize or Validate rule, it needs to implement the `RuleInterface`


Validate rules **MUST NOT** manipulate any data on on the `$subject`.
```php
use Mbright\Validation\Rule\RuleInterface;

class MyCustomValidateRule implements RuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        return $subject->$field === 'foo';
    }
}
```
Sanitize Rules **MAY** manipulate data on the subject as needed
```php
use Mbright\Validation\Rule\RuleInterface;

class MyCustomSanitizeRule implements RuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field
        
        //manipulate $value
        
        $subject->$field = $value;
        
        return true;        
    }
}
```

`$field`: A string for the name of the field to be operated on 
`$subject`: An object representing the data to be evaluated.
> This library will convert arrays to stdClass so $subject will *always* be an object

Once your rule is defined, you'll need to inject them into the the FilterFactory

```php
$validateRules = [
    'customValidate' => function() {return new MyCustomValidateRule();}
];
$sanitizeRules = [
    'customSanitize' => function() {return new MyCustomSanitizeRule;}

$factory = new ValidatorFactory($validateRules, $sanitizeRules);
$validator = $factory->newValidator();
```

Now you're ready to use the rule:

```php
$validator->sanitize('field')->to('customSanitize');
$validator->validate('field')->is('customValidate');
```
