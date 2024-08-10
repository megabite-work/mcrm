<?php

namespace App\Entity;

class Role
{
    const ROLE_ADMIN = 1;
    const ROLE_DIRECTOR = 2;
    const ROLE_MANAGER = 3;
    const ROLE_ACCOUNTANT = 4;
    const ROLE_STOCK_KEEPER = 5;
    const ROLE_CASHIER = 6;
    const ROLE_NAMES = [
        1 => ['ROLE_ADMIN'],
        2 => ['ROLE_DIRECTOR'],
        3 => ['ROLE_MANAGER'],
        4 => ['ROLE_ACCOUNTANT'],
        5 => ['ROLE_STOCK_KEEPER'],
        6 => ['ROLE_CASHIER'],
    ];

    public static function getRoles(): array
    {
        return [
            // [
            //     'id' => static::ROLE_ADMIN,
            //     'body' => [
            //         'en' => 'Admin',
            //         'ru' => 'Админ',
            //         'uz' => 'Admin',
            //         'uzc' => 'Админ',
            //     ]
            // ],
            // [
            //     'id' => static::ROLE_DIRECTOR,
            //     'body' => [
            //         'en' => 'Director',
            //         'ru' => 'Директор',
            //         'uz' => 'Direktor',
            //         'uzc' => 'Директор',
            //     ]
            // ],
            [
                'id' => static::ROLE_MANAGER,
                'body' => [
                    'en' => 'Manager',
                    'ru' => 'Менежер',
                    'uz' => 'Menejer',
                    'uzc' => 'Менежер',
                ]
            ],
            [
                'id' => static::ROLE_ACCOUNTANT,
                'body' => [
                    'en' => 'Accoutant',
                    'ru' => 'Бухгалтер',
                    'uz' => 'Buxgalter',
                    'uzc' => 'Бухгалтер',
                ]
            ],
            [
                'id' => static::ROLE_STOCK_KEEPER,
                'body' => [
                    'en' => 'Stock keeper',
                    'ru' => 'Кладовшик',
                    'uz' => 'Omborchi',
                    'uzc' => 'Омборчи',
                ]
            ],
            [
                'id' => static::ROLE_CASHIER,
                'body' => [
                    'en' => 'Cashier',
                    'ru' => 'Кассир',
                    'uz' => 'Kassir',
                    'uzc' => 'Кассир',
                ]
            ],
        ];
    }

    public static function getRoleName(int $role): array
    {
        return static::ROLE_NAMES[$role];
    }
}
