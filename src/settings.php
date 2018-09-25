<?php
return [
    'settings' => [
        'displayErrorDetails' => $_ENV['APP_ENV'] === 'dev' ? true : false, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name'  => 'b',
            'path'  => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'db' => [
            'host'      => isset($_ENV['dbhost']) ? $_ENV['dbhost'] : 'localhost',
            'username'  => isset($_ENV['dbuser']) ? $_ENV['dbuser'] : 'root',
            'password'  => isset($_ENV['dbpass']) ? $_ENV['dbpass'] : 'root',
            'database'  => isset($_ENV['dbname']) ? $_ENV['dbname'] : 'brianclincy',
            'driver'    => 'mysql',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci'
        ],
        'doctrine' => [
            // if true, metadata caching is forcefully disabled
            'dev_mode' => true,

            // path where the compiled metadata info will be cached
            // make sure the path exists and it is writable
            'cache_dir' => APP_ROOT . '/var/doctrine',

            // you should add any other path containing annotated entity classes
            'metadata_dirs' => [APP_ROOT . '/src/Entity'],

            'connection' => [
                'driver' => 'pdo_mysql',
                'host' => isset($_ENV['dbhost']) ? $_ENV['dbhost'] : 'localhost',
                'port' => isset($_ENV['dbport']) ? $_ENV['dbport'] : 3306,
                'dbname' => isset($_ENV['dbname']) ? $_ENV['dbname'] : 'brianclincy',
                'user' => isset($_ENV['dbuser']) ? $_ENV['dbuser'] : 'root',
                'password' => isset($_ENV['dbpass']) ? $_ENV['dbpass'] : 'root',
            ]
        ]
    ],
];
