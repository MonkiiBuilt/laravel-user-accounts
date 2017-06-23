<?php
/**
 * @author Jonathon Wallen
 * @date 1/5/17
 * @time 5:34 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */


return [
    'menu' => [
        'main' => [
            'laravel-administrator-user-accounts' => [
                'label' => 'Users',
                'classes' => [],
                'children' => [
                    'laravel-administrator-user-accounts-create',
                    'laravel-administrator-user-accounts-edit',
                ]
            ],
            'laravel-administrator-permissions' => [
                'label' => 'Permissions',
                'classes' => [],
                'children' => []
            ]
        ]
    ],

    'user_model' => 'App\Models\User'
];
