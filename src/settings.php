<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],
        'db' => [
            'host'  => isset($_ENV['dbhost']) ? $_ENV['dbhost'] : 'localhost',
            'user'  => isset($_ENV['dbuser']) ? $_ENV['dbuser'] : 'root',
            'pass'  => isset($_ENV['dbpass']) ? $_ENV['dbpass'] : 'root',
            'dbname'=> isset($_ENV['dbname']) ? $_ENV['dbname'] : 'brianclincy'
            ]
        ,
    ],
];
