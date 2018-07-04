# Expressive Demo Project


## Getting Started

Start the demo project:

```bash
$ git clone git@github.com:marcop73/expressive.git
```

After cloning is completed jump into the directory and install vendor libraries:

```bash
$ cd expressive && composer install
```

Run the php build in server:
```bash
$ composer run --timeout=0 serve
```

You can then browse to [http://localhost:8080](http://localhost:8080).

> ### Linux users
>
> On PHP versions prior to 7.1.14 and 7.2.2, this command might not work as
> expected due to a bug in PHP that only affects linux environments. In such
> scenarios, you will need to start the [built-in web
> server](http://php.net/manual/en/features.commandline.webserver.php) yourself,
> using the following command:
>
> ```bash
> $ php -S 0.0.0.0:8080 -t public/ public/index.php
> ```
