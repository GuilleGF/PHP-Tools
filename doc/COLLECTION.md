# Collection

## Declaration

```php
use GuilleGF\PHPTools\Collection\EntityCollection;

/**
 * Class LemonPieCollection
 */
class LemonPieCollection extends EntityCollection
{
    /**
     * @return string
     */
    public static function entityClass(): string
    {
        return LemonPie::class;
    }
}
```


## Usage

```php
$collection = new LemonPieCollection([new LemonPie()]);
```
