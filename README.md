# Main Features

You can see the features in [Features](./Features.md)

# CodeIgniter 4 API by Dhon Studio (for User)

## Database Setting

No database setting in localhost or development environment.

Create `app/Config/DatabaseDev.php` for database setting in development server or testing environment.
Fill `app/Config/DatabaseDev.php` with:

```
<?php
require 'DatabaseLocal.php';

$this-><db_group_name>['username'] = '<dev_db_username>';
$this-><db_group_name>['password'] = '<dev_db_password>';
```

Create `app/Config/DatabaseProd.php` for database setting in production server or production environment.
Fill `app/Config/DatabaseProd.php` with:

```
<?php

$this-><db_group_name>['database'] = '<prod_db_name>';
$this-><db_group_name>['username'] = '<prod_db_username>';
$this-><db_group_name>['password'] = '<prod_db_password>';
```

## Migration

Run `php spark migrate` in terminal.

## Seeder

Run `php spark db:seed <SeederName>Seeder` in terminal.

## Endpoint

Test GET, POST, PUT, DELETE, or PASSWORD VERIFY request to endpoint.

# CodeIgniter 4 API by Dhon Studio (for Developer)

## Database Setting

Create `app/Config/DatabaseLocal.php` for database setting in localhost or development environment.
Fill `app/Config/DatabaseLocal.php` with:

```
<?php

$this-><db_group_name>['database'] = '<dev_db_name>';
```

Create `app/Config/DatabaseLocal.php` and `app/Config/DatabaseDev.php` for database setting in development server or testing environment.
Fill `app/Config/DatabaseDev.php` with:

```
<?php
require 'DatabaseLocal.php';

$this-><db_group_name>['username'] = '<dev_db_username>';
$this-><db_group_name>['password'] = '<dev_db_password>';
```

Create `app/Config/DatabaseProd.php` for database setting in production server or production environment.
Fill `app/Config/DatabaseProd.php` with:

```
<?php

$this-><db_group_name>['database'] = '<prod_db_name>';
$this-><db_group_name>['username'] = '<prod_db_username>';
$this-><db_group_name>['password'] = '<prod_db_password>';
```

## Migration

Create migration file with command: `php spark make:migration <migration_name>` or `php spark migrate:create <migration_name>`.
Migration file will create on folder `app/Database/Migrations/`.
Fill migration file base on [CodeIgniter 4 migration documentation](https://codeigniter4.github.io/userguide/dbmgmt/migration.html?highlight=migration#create-a-migration).

Setting `$defaultGroup` in app/Config/Database.php with `<db_group_name>` you choose to migrate.

Run `php spark migrate` in terminal.

## Seeder

If you want to fill your migration database/table, run this command: `php spark make:seeder <SeederName> --suffix`.
Seeder file will create on folder `app/Database/Seeds/`.
Fill seeder file base on [CodeIgniter 4 seeder documentation](https://codeigniter4.github.io/userguide/dbmgmt/seeds.html).

Setting `$defaultGroup` in app/Config/Database.php with `<db_group_name>` you choose to seed.

Run `php spark db:seed <SeederName>Seeder` in terminal.

## Endpoint

Create controller and fill base on example controller.

Setting `app/Config/Routes.php` in section: Route Definitions.

Test GET, POST, PUT, DELETE, or PASSWORD VERIFY request to endpoint.

# CodeIgniter 4 Framework

## What is CodeIgniter?

CodeIgniter is a PHP full-stack web framework that is light, fast, flexible and secure.
More information can be found at the [official site](http://codeigniter.com).

This repository holds the distributable version of the framework,
including the user guide. It has been built from the
[development repository](https://github.com/codeigniter4/CodeIgniter4).

More information about the plans for version 4 can be found in [the announcement](http://forum.codeigniter.com/thread-62615.html) on the forums.

The user guide corresponding to this version of the framework can be found
[here](https://codeigniter4.github.io/userguide/).

## Important Change with index.php

`index.php` is no longer in the root of the project! It has been moved inside the _public_ folder,
for better security and separation of components.

This means that you should configure your web server to "point" to your project's _public_ folder, and
not to the project root. A better practice would be to configure a virtual host to point there. A poor practice would be to point your web server to the project root and expect to enter _public/..._, as the rest of your logic and the
framework are exposed.

**Please** read the user guide for a better explanation of how CI4 works!

## Repository Management

We use GitHub issues, in our main repository, to track **BUGS** and to track approved **DEVELOPMENT** work packages.
We use our [forum](http://forum.codeigniter.com) to provide SUPPORT and to discuss
FEATURE REQUESTS.

This repository is a "distribution" one, built by our release preparation script.
Problems with it can be raised on our forum, or as issues in the main repository.

## Contributing

We welcome contributions from the community.

Please read the [_Contributing to CodeIgniter_](https://github.com/codeigniter4/CodeIgniter4/blob/develop/CONTRIBUTING.md) section in the development repository.

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php)
- xml (enabled by default - don't turn it off)
