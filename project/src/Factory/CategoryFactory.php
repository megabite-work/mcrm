<?php

namespace App\Factory;

use App\Entity\Category;
use Zenstruck\Foundry\Persistence\PersistentProxyObjectFactory;

/**
 * @extends PersistentProxyObjectFactory<Category>
 */
final class CategoryFactory extends PersistentProxyObjectFactory
{
    public function __construct()
    {
    }

    public static function class(): string
    {
        return Category::class;
    }

    public function parent($parent): self
    {
        return $this->with(['parent' => $parent]);
    }    
    
    public function name(array $name): self
    {
        return $this->with(['name' => $name]);
    }

    protected function defaults(): array|callable
    {
        return [
            'parent' => null,
            'name' => [],
            'isActive' => self::faker()->randomElement([true, false]),
            'image' => self::faker()->imageUrl(),
            'createdAt' => self::faker()->dateTime(),
            'updatedAt' => self::faker()->dateTime(),
        ];
    }

    protected function initialize(): static
    {
        return $this
            // ->afterInstantiate(function(Category $category): void {})
        ;
    }
}
