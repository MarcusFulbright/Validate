## Documentation Index

* [Getting Started](/docs/GettingStarted.md)
* [Blank Values](/docs/BlankValues.md)
* [Custom Rules](/docs/CustomRules.md)
* [Validator Reuse](/docs/ValidateReuse.md)
* [Available Validate Rules](/docs/ValidateRules.md)

# Sanitize Rules

The following classes can get used to sanitize a field on an object:

> Note: examples below assume your files include `use Mbright\Validaiton\Rules\Sanitize`

## AlphaNum

Sanitizes to leave only alphanumeric characters

```php
$validator->sanitize('field')->to(Sanitize\AlphaNum::class);
```

## Alpha

Sanitizes to leave only alphabetic characters

```php
$validator->sanitize('field')->to(Sanitize\Alpha::class);
```

## Between($min, $max)

Sanitizes so that values lower than the range are forced up to the minimum, and values higher than the range are forced down to the maximum

```php
$validator->sanitize('field')->to(Sanitize\Between, $min, $max);
```

## Boolean($trueValue = true, $falseValue = false)

Sanitizes to a strict PHP boolean value Pseudo-true values include the strings '1', 'y', 'yes', and 'true'; pseudo-false values include the strings '0', 'n', 'no', and 'false'

```php
// sanitize to `true` and `false`
$validator->sanitize('field')->to(Sanitize\Boolean::class);
```

You can sanitize to alternative true and false values in place of PHP `true` and `false`

```php
// sanitize to alternative true and false values
$validator->sanitize('field')->to('bool', $trueValue, $falseValue);
```

## Callback

Sanitizes the value using a callable/callback The callback should take two arguments, `$subject` and `$field`, to indicate the subject and the field within that subject It should return `true` to pass, or `false` to fail

```php
$validator->sanitize('field')->to(Sanitize\Callback::class, function ($subject, $field) {
    // always force the field to 'foo'
    $subject->$field = 'foo';
    return true;
});
```

> note: Always use object notation (`$subject->$field`) and not array notation (`$subject[$field]`) in the callable, as the _Validator_ converts arrays to objects on the fly

## DateTime($format = 'Y-m-d H:i:s')

Sanitizes the value to a specified date/time format, default `'Y-m-d H:i:s'`

```php
$validator->sanitize('field')->to(Sanitize\DateTime::class, $format);
```

## Field($otherField)

Sanitizes to the value of another field in the subject

```php
$validator->sanitize('field')->to(Sanitize\Field::class, $otherField);
```

## FloatVal

Sanitizes the value to transform it into a float; for weird strings, this may not be what you expect

```php
$validator->sanitize('field')->to(Sanitize\FloatVal::class);
```

## Integer

Sanitizes the value to transform it into an integer; for weird strings, this may not be what you expect

```php
$validator->sanitize('field')->to(Sanitize\Integer::class);
```

## Isbn

Sanitizes the value to an ISBN (International Standard Book Number)

```php
$validator->sanitize('field')->to(Sanitize\Isbn::class);
```

## LowerCase

Sanitizes the value to all lowercase characters

```
$validator->sanitize('field')->to(Sanitize\LowerCase::class);
```

## LowerCaseFirst

Sanitizes the value to begin with a lowercase character

```
$validator->sanitize('field')->to(Sanitize\LowerCaseFirst::class);
```

## Max($max)

Sanitizes so that values higher than the maximum are forced down to the maximum

```php
$validator->sanitize('field')->to(Sanitize\Max::class, $max);
```

## Min($min)

Sanitizes so that values lower than the minimum are forced up to the minimum

```php
$validator->sanitize('field')->to(Sanitize\Min::class, $min);
```

## Now($format = 'Y-m-d H:i:s')

Sanitizes the value to force it to the current datetime, default format 'Y-m-d H:i:s'

```php
$validator->sanitize('field')->to(Sanitize\Now::class, $format);
```

## Remove

Removes the field from the subject with `unset()`

```php
$validator->sanitize('field')->to(Sanitize\Remove::class);
```

## Regex($expr, $replace)

Sanitizes the value using `preg_replace()`

```php
$validator->sanitize('field')->to(Sanitize\Regex::class, $expr, $replace);
```

## StringVal($find = null, $replace = null)

Sanitizes the value by casting to a string and optionally using `str_replace()` to find and replace within the string

```php
$validator->sanitize('field')->to(Sanitize\StringVal::class, $find, $replace);
```

## Strlen($len, $padString = '  ', $padType = STR_PAD_RIGHT)

Sanitizes the value to cut off longer values at the right, and `str_pad()` shorter ones

```php
$validator->sanitize('field')->to(Sanitize\Strlen::class, $len, $pad_string, $pad_type);
```

## StrlenBetween($min, $max, $padString = '  ', $padType = STR_PAD_RIGHT)

Sanitizes the value to truncate values longer than the maximum, and `str_pad()`
shorter ones

```php
$validator->sanitize('field')->to(Sanitize\StrlenBetween::class, $min, $max, $padString, $padType);
```

## StrlenMax($max)

Sanitizes the value to truncate values longer than the maximum

```php
$validator->sanitize('field')->to(Sanitize\StrlenMax::class, $max);
```

## StrlenMin($min, $padString = '  ', $padType = STR_PAD_RIGHT)

Sanitizes the value to `str_pad()` values shorter than the minimum

```php
$validator->sanitize('field')->to(Sanitize\StrlenMin::class, $min, $padString, $padType);
```

## TitleCase

Sanitizes the value to titlecase (eg "Title Case")

```php
$validator->sanitize('field')->to(Sanitize\TitleCase::class);
```

## Trim($chars = " \t\n\r\0\x0B")

Sanitizes the value to `trim()` it Optionally specify characters to trim

```php
$validator->sanitize('field')->to(Sanitize\Trim::class, $chars);
```

## UpperCase

Sanitizes the value to all uppercase characters

```php
$validator->sanitize('field')->to(Sanitize\UpperCase::class);
```

## UpperCaseFirst

Sanitizes the value to begin with an uppercase character

```php
$validator->sanitize('field')->to(Sanitize\UpperCaseFirst::class);
```

## Uuid

Forces the value to a canonical UUID

```php
$validator->sanitize('field')->to(Sanitize\Uuid::class);
```

## UuidHexOnly

Forces the value to a hex-only UUID

```php
$validator->sanitize('field')->to(Sanitize\UuidHexOnly::class);
```

## Value

Sanitizes to the specified value

```php
$validator->sanitize('field')->to(Sanitize\Value::class, $otherValue);
```

## Word

Sanitizes the value to remove non-word characters

```php
$validator->sanitize('field')->to(Sanitize\Word::class);
```
