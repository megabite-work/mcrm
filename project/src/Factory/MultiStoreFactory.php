<?php

namespace App\Factory;

use App\Entity\MultiStore;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<MultiStore>
 */
final class MultiStoreFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return MultiStore::class;
    }

    protected function defaults(): array|callable
    {
        return [
            'name' => self::faker()->company(),
            'profit' => self::faker()->text(),
            'barcodeTtn' => self::faker()->randomNumber(8),
            'nds' => self::faker()->randomElement([5, 10, 15, 20, 25]),
            'owner' => UserFactory::new(),
            'createdAt' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(MultiStore $multiStore): void {})
        ;
    }
}
