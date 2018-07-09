## Documentation Index

* [Getting Started](/docs/GettingStarted.md)
* [Blank Values](/docs/BlankValues.md)
* [Custom Rules](/docs/CustomRules.md)
* [Validator Reuse](/docs/ValidateReuse.md)
* [Available Sanitize Rules](/docs/SanitizeRules.md)

# Validate Rules

The following classes can get used to validate a field on an object:

> Note: examples below assume your files include `use Mbright\Validaiton\Rules\Validate`

## Alpha

Validates the value as only containing alphabetic characters

```php
$validator->validate('field')->is(new Validate\Alpha());
```

## AlphaDash

Validates that the value only contains alpha-numeric characters, underscores, and dashes

```php
$validator->validate('field')->is(new Validate\AlphaDash());
```

## AlphaNum

Validates the value as containing alpha-numeric values only

```php
$validator->validate('field')->is(new Validate\AlphaNum());
```

## Between($min, $max)

Validates that the value is within or equal to a minimum and maximum value

```php
$validator->validate('field')->is(new Validate\Between(1, 100));
```

## Boolean

Validates the value as being a boolean, or a pseudo-boolean Pseudo-true values include the strings '1', 'y', 'yes', and 'true'; pseudo-false values include the strings '0', 'n', 'no', and 'false'

```php
$validator->validate('field')->is(new Validate\Boolean());
```

## Callback

Validates the value using a callable/callback The callable should take two arguments, $subject and $field, to indicate the subject and the field within that subject It should return true to pass, or false to fail

```php
$callback = function ($subject, $field) {
    if ($subject->field === 'foo') {
        return true
    }
    
    return false;
};
$validator->validate('field')->is(new Validate\Callback($callback));
```

> Note: this library will convert arrays to objects, so always use object notation ($subject->$field) and _not_ array notation ($subject[$field]);


## CreditCard


Validates the value as being a credit card number

```php
$validator->validate('field')->is(new Validate\CreditCard());
```

## DateTime

Validates the value as being a valid representation of a date and/or time

```php
$validator->validate('field')->is(new Validate\DateTime());
```

## Email

Validates the value as being a valid email according to the native `filter_var` [email filter](http://phpnet/manual/en/filterfiltersvalidatephp)

```php
$validator->validate('field')->is(new Validate\Email());
```

## EqualToField($otherField)

Validates that the value is loosely equal (==) to the value of another field on the object

```php
$validator->validate('field')->is(new Validate\EqualToField('otherField'));
```

## EqualToValue($value)

Validates that the value is loosely equal (==) to the given value

```php
$validator->validate('field')->is(new Validate\EqualToValue('foo'));
```

## FloatVal

Validates that the value represents a float

```php
$validator->validate('field')->is(Validate\FloatVal::class);
``` 

## Hex($max = null)

Validates that the value is a valid hex that is not longer than the maximum length 

```php
$validator->validate('hex')->is(new Validate\Hex());
```

## InKeys($array)

Validates that the value loosely equals (==) to a key in the given array

```php
$validator->validate('field')->is(new Validate\InKeys($array));
```

## Integer

Validates that the value represents an integer

```php
$validator->validate('field')->is(new Validate\Integer());
```

## InValues($array)

Validates that the value is strictly equal (===) to a value in the given array

```php
$validator->validate('field')->is(new Validate\InValues($array));
```

## IpAddress

Validates the value as an IPv4 or IPv6 address, allowing reserved and private addresses

```php
$validator->validate('field')->is(new Validate\IpAddress());
```

To modify restrictions on the filter, pass the appropriate `FILTER_FLAG_*` constants (seen [here](http://phpnet/manual/en/filterfiltersflagsphp)) as a second parameter

```php
// only allow IPv4 addresses in the non-private range
$validator->validate('field')->is(new Validate\IpAddress(FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE));

// only allow IPv6 addresses in non-reserved range
$validator->validate('field')->is(new Validate\IpAddress(FILTER_FLAG_IPV6 | FILTER_FLAG_NO_RES_RANGE));
```

## Isbn

Validates the value is a correct ISBN (International Standard Book Number)

```php
$validator->validate('field')->is(new Validate\Isbn());
```

## Locale

Validates the given value against a list of locale strings (internal to the rule class)

```php
$validator->validate('field')->is(new Validate\Locale());
```

## Lowercase

Validates the value as all lowercase

```php
$validator->validate('field')->is(new Validate\Lowercase());
```

## LowercaseFirst

Validates the value begins with a lowercase character

```php
$validator->validate('field')->is(new Validate\LowercaseFirst());
```

## Max($max)

Validates the value as being less than or equal to a maximum

```php
$validator->validate('field')->is(new Validate\Max(class, $max));
```

## Min($min)

Validates the value as being greater than or equal to a minimum

```php
$validator->validate('field')->is(new Validate\Min(class, $min));
```

## Regex($expr)

Validates the value using `preg_match()`

```php
$validator->validate('field')->is(new Validate\Regex($expr));
```

## StrictEqualToField($otherField)

Validates the value as strictly equal (`===`) to the value of another field in the subject

```php
$validator->validate('field')->is(new Validate\StrictEqualToField('otherFieldName'));
```

## StrictEqualToValue($value)

Validates the value as strictly equal (`===`) to a specified value

```php
$validator->validate('field')->is(new Validate\StrictEqualToValue($value));
```

## String

Validates the value can be represented by a string

```php
$validator->validate('field')->is(new Validate\String());
```

## Strlen($len)

Validates the value has a specified length

```php
$validator->validate('field')->is(new Validate\Strlen($len));
```

## StrlenBetween($min, $max)

Validates the value as being within or equal to a minimum and maximum length

```php
$validator->validate('field')->is(new Validate\StrlenBetween($min, $max);
```

## StrlenMax($max)

Validates the value length as being no longer than a maximum

```php
$validator->validate('field')->is(new Validate\StrlenMax($max));
```

## StrlenMin($min)

Validates the value length as being no shorter than a minimum

```php
$validator->validate('field')->is(new Validate\StrlenMin($min));
```

## TitleCase

Validates the value as title case

```php
$validator->validate('field')->is(new Validate\TitleCase());
```

## Trim($chars = ' \t\n\r\0\x0B')

Validates the value is `trim()`med Optionally specify characters to trim

```php
$validator->validate('field')->is(new Validate\Trim($chars));
```

## Upload

Validates the value represents a PHP upload information array, and that the file is an uploaded file

```php
$validator->validate('field')->is(new Validate\Upload());
```

## UpperCase

Validates the value as all uppercase

```php
$validator->validate('field')->is(new Validate\UpperCase());
```

## UpperCaseFirst

Validates the value begins with an uppercase character

```php
$validator->validate('field')->is(new Validate\UpperCaseFirst());
```

## Url

Validates the value is a well-formed URL

```php
$validator->validate('field')->is(new Validate\Url());
```

## Uuid

Validates that the value is a canonical human-readable UUID

```php
$validator->validate('field')->is(new Validate\Uuid());
```

## UuidHexOnly

Validates that the value is a hex-only UUID

```php
$validator->validate('field')->is(new UuidHexOnly());
```

## Word

Validates the value as being composed only of word characters

```php
$validator->validate('field')->is(new Validate\Word());
```
