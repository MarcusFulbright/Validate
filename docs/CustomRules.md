## Documentation Index

* [Getting Started](/docs/GettingStarted.md)
* [Blank Values](/docs/BlankValues.md)
* [Validator Reuse](/docs/ValidateReuse.md)
* [Available Sanitize Rules](/docs/SanitizeRules.md)
* [Available Validate Rules](/docs/ValidateRules.md)
  + [MySql Rules](/docs/MySql.md)

# Custom Rules

Defining your own custom Sanitize and Validate rules is very easy. The bare bones for each rule look the same:

```php
public function __invoke($subject, string $field): bool
{
    // do something
}
```

`$field`: A string for the name of the field to be operated on
 
`$subject`: An object representing the data to be evaluated.

> This library will convert arrays to stdClass so $subject will *always* be an object

If your rule requires any additional arguments, they should get injected into the rule's `__construct()`.

Additionally, custom rules will need to implement either the `ValidateRuleInterface` or `SanitizeRuleInterface` depending on the rule type.

## Custom Validate Rules
Validate rules **MUST NOT** manipulate any data on on the `$subject` and **MUST** return a boolean. Additionally, they **must** implement `ValidateRuleInterface` 

```php
use Mbright\Validation\Rule\Validate\ValidateRuleInterface;

class MyCustomValidateRule implements ValidateRuleInterface
{
    protected $value;
    
    public function __construct($value = 'foo')
    {
        $this->value = $value;
    }
    
    public function __invoke($subject, string $field): bool
    {
        return $subject->$field === $this->value;
    }
}
```

## Custom Sanitize Rule
Sanitize Rules **MAY** manipulate data on the subject as needed and **MUST** return a boolean. Additionally, Sanitize rules **must** implement `SanitizeRuleInterface`

```php
use Mbright\Validation\Rule\Sanitize\SanitizeRuleInterface;

class MyCustomSanitizeRule implements SanitizeRuleInterface
{
    public function __invoke($subject, string $field): bool
    {
        $value = $subject->$field
        
        //manipulate $value
        
        $subject->$field = $;
        
        return true;        
    }
}
```

## Using Custom Rules:

Once your rule is defined, you can pass it to a Validator like any other rule:

```php
$factory = new ValidatorFactory();
$validator = $factory->newValidator();

$validator->sanitize('field')->to(new new MyCustomSanitizeRule());
$validator->validate('field')->is(new MyCustomValidateRule());
```
