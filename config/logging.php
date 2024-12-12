<?php

return [
    'default' => env('LOG_CHANNEL', 'stack'),

    'channels' => [
        // Канал stack, который будет использовать несколько каналов
        'stack' => [
            'driver' => 'stack',
            'channels' => ['single', 'daily'],  // Логирование будет использовать и "single" и "daily"
            'ignore_exceptions' => false,
        ],

        // Канал "single" записывает логи в один файл
        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        // Канал "daily" записывает логи в отдельные файлы по дням
        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => env('LOG_LEVEL', 'debug'),
            'days' => 14,  // Количество дней хранения логов
        ],

        // Канал "stderr" (для вывода в стандартный поток ошибок)
        'stderr' => [
            'driver' => 'stderr',
            'level' => env('LOG_LEVEL', 'debug'),
        ],

        // Другие каналы могут быть добавлены по необходимости (например, для логирования в базы данных, внешние сервисы и т.д.)
    ],
];
