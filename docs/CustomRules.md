## Documentation Index

* [Getting Started](/docs/GettingStarted.md)
* [Blank Values](/docs/BlankValues.md)
* [Validator Reuse](/docs/ValidateReuse.md)
* [Available Sanitize Rules](/docs/SanitizeRules.md)
* [Available Validate Rules](/docs/ValidateRules.md)

# Custom Rules

Defining your own custom Sanitize and Validate rules is very easy. The bare bones for each rule look the same:

```php
use Mbright\Validation\Rule\RuleInterface;

class MyCustomValidateRule implements RuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        // do something
    }
}
```

`$field`: A string for the name of the field to be operated on
 
`$subject`: An object representing the data to be evaluated.

> This library will convert arrays to stdClass so $subject will *always* be an object

If your rule requires any additional arguments, they can be added to the method signature after the `$field` argument.

## Custom Validate Rules
Validate rules **MUST NOT** manipulate any data on on the `$subject` and **MUST** return a boolean.

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

## Custom Sanitize Rule
Sanitize Rules **MAY** manipulate data on the subject as needed and **MUST** return a boolean.

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

## Using Custom Rules:

Once your rule is defined, you'll need to inject it into the the FilterFactory:

```php
$validateRules = [
    'customValidate' => function() {return new MyCustomValidateRule();}
];
$sanitizeRules = [
    'customSanitize' => function() {return new MyCustomSanitizeRule;}

$factory = new ValidatorFactory($validateRules, $sanitizeRules);
$validator = $factory->newValidator();

//Now you're ready to use the rule:

$validator->sanitize('field')->to('customSanitize');
$validator->validate('field')->is('customValidate');
```
