# Laravel Installer

A Laravel project installer.

### Installation

Install via composer:

```
composer require yk/laravel-installer
```

And add the service provider in config/app.php:

```php
Yk\LaravelInstaller\InstallerProvider::class,
```

Make sure that a .env.example file exist in your project base path. The installer is using it as a scaffold.

If you want to use table prefix option, add DB_PREFIX to the .env.example file and change the config/database.php by adding env('DB_PREFIX', '') in the mysql connexion array as follow:

```php
...
'mysql' => [
    'driver' => 'mysql',
    'host' => env('DB_HOST', 'localhost'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    //'prefix' => '', // Old
    'prefix' => env('DB_PREFIX', ''), // Here
    'strict' => true,
    'engine' => null,
],
...
```

That's all, the installer will be triggered when .env is missing.

## License

### GPLv2

Copyright (c) 2016 Yassine Khachlek <yassine.khachlek@gmail.com>

This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.