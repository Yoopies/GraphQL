# Upgrade guide — PHP 8.2 / Symfony 5.4–7.x (v2.0.0)

## Requirements

- **PHP**: >= 8.2
- **symfony/property-access**: `^5.4 || ^6.0 || ^7.0`
- **PHPUnit** (dev): `^9.6`

## How to upgrade

```bash
composer update
vendor/bin/phpunit
```

## Notable changes

This version merges the [TomAtomCZ/GraphQL](https://github.com/TomAtomCZ/GraphQL) fork
(PHP 8 modernization: typed properties, return types, plus many type-related bugfixes)
on top of the Yoopies changes.

### Behavior changes to watch for in consuming applications

1. **Error deduplication** — identical exceptions added twice to an error container are
   now reported only once in the GraphQL `errors` response.

2. **`DateType`** — now implemented on top of `DateTimeType` (format `Y-m-d`);
   `parseValue()` returns a `DateTime` instance instead of the raw value.
   `DateType` is deprecated, use `DateTimeType` instead.

3. **Strict types instead of runtime checks** — methods such as
   `SchemaDirectivesList::addDirectives(array $directives)` now declare native parameter
   types. Passing an invalid type throws `TypeError` (an `Error`) rather than `Exception`,
   so `catch (\Exception $e)` blocks no longer intercept these mistakes.

4. **Magic `__get` resolution** — since symfony/property-access 6.x,
   `TypeService::getPropertyValue($object, 'prop')` resolves a magic `__get` property
   only when the class also implements `__isset`. Objects exposing values solely through
   `__get` must add `__isset` to keep working.

5. **AST constructor signatures** — `Variable` and `VariableReference` constructors moved
   the `Location $location` parameter before the optional parameters:
   - `new Variable($name, $type, $nullable, $isArray, Location $location, $arrayElementNullable = true)`
   - `new VariableReference($name, Location $location, ?Variable $variable = null)`

6. **Error messages** — unknown-field errors keep the short Yoopies format
   (`Field "x" not found in type "Y".`) and do not disclose the list of available fields.

## Continuous integration

Travis CI was replaced by GitHub Actions (`.github/workflows/ci.yml`):
PHPUnit on PHP 8.2/8.3/8.4 against Symfony property-access 5.4 (lowest), 6.4 and 7.x,
plus a phpstan (level 1) job.
