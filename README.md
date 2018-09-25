# Brian Clincy's Personal Web site
 
Using slim php framework for the backend, and vanilla javascript, bootstrap, jquery, bower, gulp and npm libraries for 
front-end all used at [brianclincy.com](http://brianclincy.com)

## Installing


## Project structure

```
b-slim-php
├── public
│   └── asset                 -- Asset folder
│       └── codevideo.mp4   -- background video (requires ../bootstrap.php)
│   └── css                 -- Asset folder
│       └── default.css     -- Apache redirect (requires ../bootstrap.php)
│   └── .htaccess             -- Apache redirect (requires ../bootstrap.php)
│   └── bootstrap.php         -- HTTP front controller (requires ../bootstrap.php)
│   └── index.php             -- HTTP front controller (requires ../bootstrap.php)
│   └── index.html            -- HTTP front controller (requires ../bootstrap.php)
├── src
│   ├── Action              -- Slim request handlers
│   │   ├── CreateUser.php
│   │   └── ListUsers.php
│   ├── Entity              -- Annotated entity classes
│   │   └── User.php
│   └── Provider
│       ├── Doctrine.php    -- EntityManager service definition
│       └── Slim.php        -- Slim service definitions
├── tests/                  -- Automated tests
├── var
│   ├── coverage/           -- Test coverage results in HTML
│   ├── doctrine/           -- Doctrine metadata cache
│   └── database.sqlite     -- Development database
├── bootstrap.php           -- DI container setup (requires ./settings.php)
├── composer.json
├── LICENSE
├── phpunit.xml.dist
├── README.md
├── settings.php            -- Settings currently in use (not committed to Git)
├── settings_devel.php      -- Settings for development
└── settings_test.php       -- Settings for running the tests
```

## Running the app

Typing `composer serve` in a console will install the project dependencies, create the database and open
the API at `http://localhost:8000`. Once it is running you can make requests against it with a browser,
curl or similar tools.