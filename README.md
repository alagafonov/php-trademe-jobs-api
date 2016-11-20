[![Build Status](https://api.travis-ci.org/alagafonov/php-trademe-jobs-api.svg?branch=master)](https://api.travis-ci.org/alagafonov/php-trademe-jobs-api)
[![StyleCI](https://styleci.io/repos/72507203/shield?style=flat)](https://styleci.io/repos/72507203)

# Trademe.co.nz Jobs APIs Client Library for PHP #

## Description ##
Trademe.co.nz Jobs APIs Client Library provides endpoints for managing, listing, and retrieving job listings. These are a subset of all of the functionality available across Trade Me but should provide a good starting point for starting to list and manage jobs through the API.

## Requirements ##
* [PHP 5.5.0 or higher](http://www.php.net/)

## Developer Documentation ##
http://developer.trademe.co.nz/getting-started/

## Installation via Composer ##

```bash
composer require alagafonov/php-trademe-jobs-api:1.0.0-beta
```

## Examples ##

```php
// include composer dependencies
require_once 'vendor/autoload.php';

$client = new Client();
$client->authenticate(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, TOKEN_SECRET);
$listing = $client->listing()->retrieve(5032388);
```

## License

Library is licensed under the MIT License - see the LICENSE file for details

## Sponsored by

[<img src="http://www.subscribe-hr.com.au/hs-fs/hubfs/subscribe_hr_logo_tech.png" width="200">](http://www.subscribe-hr.com.au/)
