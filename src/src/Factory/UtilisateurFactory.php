<?php

namespace App\Factory;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Utilisateur>
 *
 * @method static Utilisateur|Proxy createOne(array $attributes = [])
 * @method static Utilisateur[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Utilisateur[]|Proxy[] createSequence(array|callable $sequence)
 * @method static Utilisateur|Proxy find(object|array|mixed $criteria)
 * @method static Utilisateur|Proxy findOrCreate(array $attributes)
 * @method static Utilisateur|Proxy first(string $sortedField = 'id')
 * @method static Utilisateur|Proxy last(string $sortedField = 'id')
 * @method static Utilisateur|Proxy random(array $attributes = [])
 * @method static Utilisateur|Proxy randomOrCreate(array $attributes = [])
 * @method static Utilisateur[]|Proxy[] all()
 * @method static Utilisateur[]|Proxy[] findBy(array $attributes)
 * @method static Utilisateur[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Utilisateur[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static UtilisateurRepository|RepositoryProxy repository()
 * @method Utilisateur|Proxy create(array|callable $attributes = [])
 */
final class UtilisateurFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();

        // TODO inject services if required (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#factories-as-services)
    }

    protected function getDefaults(): array
    {
        return [
            // TODO add your default values here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories)
            'name' => self::faker()->firstName(),
            'password' => self::faker()->password(6,12),
            'email' => self::faker()->email(),
            'isAdmin' => self::faker()->boolean(),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
             ->afterInstantiate(function(Utilisateur $utilisateur): void {
                 $utilisateur->setEmail(strtolower(sprintf("%s@gmail.com", $utilisateur->getName())));
             })
        ;
    }

    protected static function getClass(): string
    {
        return Utilisateur::class;
    }
}
