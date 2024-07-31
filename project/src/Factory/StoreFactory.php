<?php

namespace App\Factory;

use App\Entity\Store;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Store>
 */
final class StoreFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Store::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->company(),
            'isActive' => self::faker()->randomElement([true, false]),
            'officialAddress' => self::faker()->address(),
            'coordinate' => '"' . self::faker()->latitude() . ',' . self::faker()->longitude() . '"',
            'multiStore' => MultiStoreFactory::new(),
            'createdAt' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Store $store): void {})
        ;
    }
}
