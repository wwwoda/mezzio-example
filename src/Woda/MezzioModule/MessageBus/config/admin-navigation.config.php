<?php

declare(strict_types=1);

namespace Woda\MezzioModule\MessageBus;

return [
    'menu' => [
        'admin' => [
            'items' => [
                'message-bus' => [
                    'type' => 'route',
                    'route' => 'admin/message-bus-log',
                    'label' => ['message' => 'menu_admin_message_bus_label', 'type' => TranslatedMenuString::class],
                    'permission' => ViewMessageBusLog::class,
                    'order' => 80,
                ],
            ],
        ],
    ],
];
