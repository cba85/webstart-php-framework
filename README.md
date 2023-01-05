# Webstart PHP framework

> For demonstration purpose only

A simple example of a PHP framework made for Webstart school.

![Webstart logo](./docs/Fichier-4logo.png)

## Install

```bash
$ composer install
```

Set up env variables by copying and setting `.env.example` file contents in a `.env` file.

## Usage

```bash
$ php -S 0.0.0.0:8080 -t public/
# or
$ composer run serve
```

## Dependencies

See [composer.json](./composer.json) file for all dependencies

* `.env` file
* Carbon for dates
* League route as router
* Twig for template engine

### Dev

* Whoops error
* Faker