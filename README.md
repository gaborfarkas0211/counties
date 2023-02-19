# Countes
This is a county-to-city mapping application. You can add a city to a selected county, then you can edit and delete it.

## Requirements

- PHP v8.1
- Composer
- Npm

## Installation

- Create a new database
- Run the `composer deploy` to install and build dependencies

## Usage
- Run `php -S 127.0.0.1:8080 -t public` command to start the application

## Tests
By default (if you used `composer deploy` script), the dev dependencies did not installed. 
- Run `composer install --dev` command.
- Run `php artisan test`

## Author
* Gábor Farkas
## License
[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg)](https://www.gnu.org/licenses/gpl-3.0)
