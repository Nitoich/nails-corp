<?php

return [
    'v1' => [
        [
            'path' => '/api/v1/login',
            'method' => 'POST',
            'options' => [
                'phone' => [
                    'type' => 'string',
                    'description' => 'Номер телефона в формате 7ХХХХХХХХХХ'
                ],
                'password' => [
                    'type' => 'string',
                    'description' => ''
                ]
            ],
            'responses' => [
                '200' => [
                    'headers' => [
                        'Cookie' => 'refresh_token'
                    ],
                    'data' => [
                        'data' => [
                            ''
                        ]
                    ]
                ]
            ]
        ]
    ]
];
