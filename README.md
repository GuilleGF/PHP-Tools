# PHP-Tools
Several PHP 7 tools to make life a little easier

## Installation

```
composer require guillegf/php-tools
```

## Enum
Using an enum instead of class constants provides the following advantages:

- You can type-hint: `function setAction(Action $action) {`
- You can enrich the enum with methods (e.g. `format`, `parse`, …)
- You can extend the enum to add new values (make your enum `final` to prevent it)
- You can get a list of all the possible values (see below)

This Enum class is not intended to replace class constants, but only to be used when it makes sense.

Enum class based on project [`myclabs/php-enum`](https://github.com/myclabs/php-enum)

### Declaration

```php
use GuilleGF\PHPTools\Tests\Enum;

/**
 * Action enum
 */
class Action extends Enum
{
    const VIEW = 'view';
    const EDIT = 'edit';
}
```


### Usage

```php
$action = new Action(Action::VIEW);

// or
$action = Action::view();
```

As you can see, static methods are automatically implemented to provide quick access to an enum value.

One advantage over using class constants is to be able to type-hint enum values:

```php
function setAction(Action $action) {
    // ...
}
```

### Documentation

- `__construct()` The constructor checks that the value exist in the enum
- `__toString()` You can `echo $myValue`, it will display the enum value (value of the constant)
- `value()` Returns the current value of the enum
- `key()` Returns the key of the current value on Enum
- `equals()` Tests whether enum instances are equal (returns `true` if enum values are equal, `false` otherwise)

Static methods:

- `toArray()` method Returns all possible values as an array (constant name in key, constant value in value)
- `keys()` Returns the names (keys) of all constants in the Enum class
- `values()` Returns instances of the Enum class of all Enum constants (constant name in key, Enum instance in value)
- `isValid()` Check if tested value is valid on enum set
- `isValidKey()` Check if tested key is valid on enum set
- `search()` Return key for searched value

#### Static and magic methods

```php
class Action extends Enum
{
    const VIEW_POST = 'view';
    const EDIT = 'edit';
}

// Static method:
$action = Action::viewPost();
$action = Action::edit();

// Magic method:
$actionEdit = Action::edit();
$actionEdit->isEdit() // return true 
```

Static method helpers are implemented using [`__callStatic()`](http://php.net/manual/en/language.oop5.overloading.php#object.callstatic).
Magic method helpers are implemented using [`__callS()`](http://php.net/manual/en/language.oop5.overloading.php#object.call).

If you care about IDE autocompletion, you can either implement the static methods yourself:

```php
class Action extends Enum
{
    const VIEW_POST = 'view';

    /**
     * @return Action
     */
    public static function viewPost() {
        return new Action(self::VIEW_POST);
    }
}
```

or you can use phpdoc (this is supported in PhpStorm for example):

```php
/**
 * @method static Action view()
 * @method static Action editPost()
 */
class Action extends Enum
{
    const VIEW_POST = 'view';
    const EDIT = 'edit';
}
```