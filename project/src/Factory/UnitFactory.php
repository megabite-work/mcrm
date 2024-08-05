<?php

namespace App\Factory;

use App\Entity\Unit;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Unit>
 */
final class UnitFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Unit::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'name' => ['uz' => self::faker()->randomNumber(7, true), 'uzc' => self::faker()->randomNumber(7, true), 'ru' => self::faker()->randomNumber(7, true)],
            'code' => self::faker()->randomNumber(7, true),
            'icon' => self::faker()->imageUrl(),
            'createdAt' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Unit $unit): void {})
        ;
    }
}
