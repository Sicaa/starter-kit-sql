# starter-kit-sql 

PHP singleton for PDO

[![Latest Stable Version](https://poser.pugx.org/starter-kit/sql/v/stable)](https://packagist.org/packages/starter-kit/sql) [![License](https://poser.pugx.org/starter-kit/sql/license)](https://packagist.org/packages/starter-kit/sql)

## Requirements

- PHP >= 5.3
- PHP PDO extension

## Installation

Install directly via [Composer](https://getcomposer.org/):
```bash
$ composer require starter-kit/sql
```

## Basic Usage

```php
<?php

// Require your autoloading script (Composer autoload here) to use namespaces
require_once 'vendor/autoload.php';

use StarterKit\SQL\SimplePDO;

// First instanciation : pass your DB parameters
$PDOInstance = SimplePDO::getInstance('YOUR_DB_NAME', 'YOUR_DB_SERVER', 'YOUR_DB_PORT', 'YOUR_DB_USER', 'YOUR_DB_PASSWORD');

// Later in your code : you can retrieve your instance at any time, without creating new PDO connection
$query = SimplePDO::getInstance()->prepare('SELECT * FROM YOUR_DB_TABLE');
$res = $query->execute();
```