<?php
return [
    'paths'=>[
        'main' => app_path() . '/Modules',
        'relative'=>[
            'config' => '/config',
            'routes' => '/Http/routes.php',
            'views' => '/resources/views',
        ]
    ],
    'keys'=>[
        'basekey' => 'module.',
    ],
];
