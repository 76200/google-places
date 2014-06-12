GooglePlaces
============

The `GooglePlaces` library is a `PHP` wrapper for [Google Places API](https://developers.google.com/places/documentation/)

[![Build Status](https://travis-ci.org/76200/google-places.svg?branch=master)](https://travis-ci.org/76200/google-places)
[![Coverage Status](https://coveralls.io/repos/76200/google-places/badge.png)](https://coveralls.io/r/76200/google-places)

## Instalation


`GooglePlaces` uses [Composer](https://getcomposer.org/) for autoloading.

Add `bart/google-places` to your `composer.json`

    "require": {
        "bart/google-places": "dev-master"
    }

Or execute `composer.phar require "bart/google-places:dev-master"`

### Note

`GooglePlaces` follows the PSR-4 standard for autoloading.

## Usage

```php
<?php

require_once 'vendor/autoload.php';

use bart\GooglePlaces\GooglePlaces;

$places = new GooglePlaces('<<YOUR_API_KEY>>');
```
### Nearby Search

Method declaration:

```php
public function nearbySearch(array $location, $radius, $sensor, array $parameters = [])
```

Example usage:

```php
$result = $places
    ->nearbySearch([54.465224,17.017558], 2000, false, ['keyword' => 'coffee',])
    ->arrayResult();
```

Returns `SearchResult` object

### Next Page

Method declaration:

```php
public function next()
```

Example usage:

**Important!**: You can execute `next` method only when previous query returned valid result containing `next_page_token`

```php
$result = $places
    ->next()
    ->arrayResult();
```

## Info

This repository is under heavy development, the goal is to implement and test all `Google Places API` functions.
