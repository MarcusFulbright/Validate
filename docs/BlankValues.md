## Documentation Index

* [Getting Started](/docs/GettingStarted.md)
* [Custom Rules](/docs/CustomRules.md)
* [Validator Reuse](/docs/ValidateReuse.md)
* [Available Sanitize Rules](/docs/SanitizeRules.md)
* [Available Validate Rules](/docs/ValidateRules.md)

# On Blank Values:

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

## Sanitize Rules & Blanks

If a Sanitize Rule cannot be ran successfully, the rule can set the field to an acceptable blank value:

Example:
```php
//Sanitize a field to a boolean, or set it to false
$validator->sanitize('someField')->to('bool')->usingBlank(false)
```

## Validate Rules & Blanks

Validation rules can be configured to allow blank values.

Example

```php
$validator->validate('fieldName')->is('rule')->allowBlanks();
```

> Note: If the field is a valid blank value, then the rule will never get invoked

### Specifying Acceptable BlankValues

A custom white list list of blank values can be used for a specific rule. Any values supplied in this fashion will override the default behavior for blank values.

```php
$whiteList = [
  0,
  false
];
$validator->validate('field')->setBlankValues($whiteList);
$validator->sanitize('field')->setBlankValues($whiteList);
```


