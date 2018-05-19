## Validator Reuse
It can become tedious to configure every Validator on the fly. Instead, you might find it advantageous to have a custom Validator class that already has all of its own rules and messages pre-configured. To do so, simply extend the Validator class and override its `init()` method:

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

Your class will be ready to use as soon as you instantiate an instance of it:

```php
$validator = new CustomValidator();

$validator->apply($someObject);
```