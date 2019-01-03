# MySql Rules

The following rules are intended to be compatible with MySql column definitions:

## Validation Rules

> Note: examples below assume your files include `use Mbright\Validaiton\Rules\Validate\MySql`

### BigInt($signed)

```
$validator->validate->('field')->is(new MySql\BigInt($signed));
```

### Bit($size)

> The rule works be validating that the field is an integer that can be expressed in the desired number of bits

```
$validator->validate('field')->is(new MySql\Bit($size));
```

### Blob($len)

Compatible with: Blob, Text

```
$validator->validate('field')->is(new MySql\Blob($len));
```

### Char($len)

```
$validadtor->validate('field')->is(new MySql\Char($len));
```

### Date()

```
$validator->validate('field')->is(new MySql\Date());
```

### DateTime()

```
$validator->validate('field')->is(new Mysql\DateTime());
```

### Enum($acceptedValues)

```
$validator->validate('field)->is(new MySql\Enum($acceptedValues));
```

### LongBlob($len)

```
$validator->validate('field')->is(new MySql\LongBlob($len));
```

### MediumBlob($len)

```
$validator->validate('field')->is(new MySql\MediumBlob($len));
```

### MediumInt()

```
$validator->validate('field')->is(new MySql\MediumInt());
```

### PointNumber($precision, $scale)

Compatible with: Decimal, Numeric, Float, and Double

```
$validator->validate('field')->is(new MySql\PointNumber($precision, $scale));
```

### SmallInt()

```
$validator->validate('field')->is(new MySql\SmallInt());
```

### StandardInt()

Compatible with: Int

```
$validator->validate('field')->is(new MySql\StandardInt());
```

### Time()

```
$validator->validate('field')->is(new MySql\Time());
```

### TinyBlob($len)

Compatible with: TinyBlob, TinyText

```
$validator->validate('field')->is(new MySql\TinyBlob($len));
```

### TinyInt()

```
$validator->validate('field')->is(new MySql\TinyInt());
```

### VarChar($len)

```
$validator->validate('field')->is(new MySql\VarChar($len));
```

### Year()

```
$validator->validate('field')->is(new MySql\Year());
```


