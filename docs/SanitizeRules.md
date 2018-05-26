## Documentation Index

* [Getting Started](/docs/GettingStarted.md)
* [Blank Values](/docs/BlankValues.md)
* [Custom Rules](/docs/CustomRules.md)
* [Validator Reuse](/docs/ValidateReuse.md)
* [Available Validate Rules](/docs/ValidateRules.md)

# Sanitize Rules

## alphaNum

Sanitizes to leave only alphanumeric characters

```php
$validator->sanitize('field')->to('alphaNum');
```

## alpha

Sanitizes to leave only alphabetic characters

```php
$validator->sanitize('field')->to('alpha');
```

## between($min, $max)

Sanitizes so that values lower than the range are forced up to the minimum, and values higher than the range are forced down to the maximum

```php
$validator->sanitize('field')->to('between', $min, $max);
```

## bool($trueValue = true, $falseValue = false)

Sanitizes to a strict PHP boolean value Pseudo-true values include the strings '1', 'y', 'yes', and 'true'; pseudo-false values include the strings '0', 'n', 'no', and 'false'

```php
// sanitize to `true` and `false`
$validator->sanitize('field')->to('bool');
```

You can sanitize to alternative true and false values in place of PHP `true` and `false`

```php
// sanitize to alternative true and false values
$validator->sanitize('field')->to('bool', $trueValue, $falseValue);
```

## callback

Sanitizes the value using a callable/callback The callback should take two arguments, `$subject` and `$field`, to indicate the subject and the field within that subject It should return `true` to pass, or `false` to fail

```php
$validator->sanitize('field')->to('callback', function ($subject, $field) {
    // always force the field to 'foo'
    $subject->$field = 'foo';
    return true;
});
```

> note: Always use object notation (`$subject->$field`) and not array notation (`$subject[$field]`) in the callable, as the _Validator_ converts arrays to objects on the fly

## dateTime($format = 'Y-m-d H:i:s')

Sanitizes the value to a specified date/time format, default `'Y-m-d H:i:s'`

```php
$validator->sanitize('field')->to('dateTime', $format);
```

## field($otherField)

Sanitizes to the value of another field in the subject

```php
$validator->sanitize('field')->to('field', $otherField);
```

## float

Sanitizes the value to transform it into a float; for weird strings, this may not be what you expect

```php
$validator->sanitize('field')->to('float');
```

## int

Sanitizes the value to transform it into an integer; for weird strings, this may not be what you expect

```php
$validator->sanitize('field')->to('int');
```

## isbn

Sanitizes the value to an ISBN (International Standard Book Number)

```php
$validator->sanitize('field')->to('isbn');
```

## lowercase

Sanitizes the value to all lowercase characters

```
$validator->sanitize('field')->to('lowercase');
```

## lowercaseFirst

Sanitizes the value to begin with a lowercase character

```
$validator->sanitize('field')->to('lowercaseFirst');
```

## max($max)

Sanitizes so that values higher than the maximum are forced down to the maximum

```php
$validator->sanitize('field')->to('max', $max);
```

## min($min)

Sanitizes so that values lower than the minimum are forced up to the minimum

```php
$validator->sanitize('field')->to('min', $min);
```

## now($format = 'Y-m-d H:i:s')

Sanitizes the value to force it to the current datetime, default format 'Y-m-d H:i:s'

```php
$validator->sanitize('field')->to('now', $format);
```

## remove

Removes the field from the subject with `unset()`

```php
$validator->sanitize('field')->to('remove');
```

## regex($expr, $replace)

Sanitizes the value using `preg_replace()`

```php
$validator->sanitize('field')->to('regex', $expr, $replace);
```

## string($find = null, $replace = null)

Sanitizes the value by casting to a string and optionally using `str_replace()` to find and replace within the string

```php
$validator->sanitize('field')->to('string', $find, $replace);
```

## strlen($len, $padString = '  ', $padType = STR_PAD_RIGHT)

Sanitizes the value to cut off longer values at the right, and `str_pad()` shorter ones

```php
$validator->sanitize('field')->to('strlen', $len, $pad_string, $pad_type);
```

## strlenBetween($min, $max, $padString = '  ', $padType = STR_PAD_RIGHT)

Sanitizes the value to truncate values longer than the maximum, and `str_pad()`
shorter ones

```php
$validator->sanitize('field')->to('strlenBetween', $min, $max, $padString, $padType);
```

## strlenMax($max)

Sanitizes the value to truncate values longer than the maximum

```php
$validator->sanitize('field')->to('strlenMax', $max);
```

## strlenMin($min, $padString = '  ', $padType = STR_PAD_RIGHT)

Sanitizes the value to `str_pad()` values shorter than the minimum

```php
$validator->sanitize('field')->to('strlenMin', $min, $padString, $padType);
```

## titlecase

Sanitizes the value to titlecase (eg "Title Case")

```php
$validator->sanitize('field')->to('titlecase');
```

## trim($chars = " \t\n\r\0\x0B")

Sanitizes the value to `trim()` it Optionally specify characters to trim

```php
$validator->sanitize('field')->to('trim', $chars);
```

## uppercase

Sanitizes the value to all uppercase characters

```
$validator->sanitize('field')->to('uppercase');
```

## uppercaseFirst

Sanitizes the value to begin with an uppercase character

```
$validator->sanitize('field')->to('uppercaseFirst');
```

## value

Sanitizes to the specified value

```php
$validator->sanitize('field')->to('value', $otherValue);
```

## word

Sanitizes the value to remove non-word characters

```php
$validator->sanitize('field')->to('word');
```
