# WebRcon

[![Latest Version on Packagist](https://img.shields.io/packagist/v/scai/php-webrcon.svg?style=flat-square)](https://packagist.org/packages/scai/php-webrcon)
[![Tests](https://github.com/alexevladgabriel/php-webrcon/actions/workflows/run-tests.yml/badge.svg?branch=main)](https://github.com/alexevladgabriel/php-webrcon/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/scai/php-webrcon.svg?style=flat-square)](https://packagist.org/packages/scai/php-webrcon)

PHP library to send & receive commands from rust server based on websocket client.

## Installation

You can install the package via composer:

```bash
composer require scai/php-webrcon
```

## Usage

```php
$rcon = new Scai\WebRcon\WebRconClass('IP', PORT, 'RCON PASSWORD');
$rcon->command('serverinfo');
$data = $rcon->receive();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Alexe Vlad](https://github.com/alexevladgabriel)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
