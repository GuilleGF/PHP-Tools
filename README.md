# PHP-Tools
[![Build Status](https://travis-ci.org/GuilleGF/PHP-Tools.svg?branch=master)](https://travis-ci.org/GuilleGF/PHP-Tools)
[![Code Coverage](https://scrutinizer-ci.com/g/GuilleGF/PHP-Tools/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/GuilleGF/PHP-Tools/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/GuilleGF/PHP-Tools/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/GuilleGF/PHP-Tools/?branch=master)

Several PHP 7 tools to make life a little easier

## Installation

```
composer require guillegf/php-tools
```

## Enum
PHP Enum implementation inspired from [`SplEnum`](http://php.net/manual/es/class.splenum.php) and based on project [`myclabs/php-enum`](https://github.com/myclabs/php-enum) because it is not integrated to PHP, you have to install it separately.

Using an enum instead of class constants provides the following advantages:

- You can type-hint: `function setAction(Action $action) {`
- You can enrich the enum with methods (e.g. `format`, `parse`, …)
- You can extend the enum to add new values (make your enum `final` to prevent it)
- You can get a list of all the possible values (see below)

This Enum class is not intended to replace class constants, but only to be used when it makes sense.

[See documentation](doc/ENUM.md)

## Collection
PHP EntityCollection implementation inspired on [`ArrayCollection`](https://github.com/doctrine/collections/blob/master/lib/Doctrine/Common/Collections/ArrayCollection.php) from project [`doctrine/collections`](https://github.com/doctrine/collections).

[See documentation](doc/COLLECTION.md)
