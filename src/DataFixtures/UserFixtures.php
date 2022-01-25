<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);
    }

    private function loadUsers(ObjectManager $manager): void
    {
        foreach ($this->getUserData() as [$publicName, $username, $password, $email, $role]) {
            $user = new User();
            $user->setPublicName($publicName);
            $user->setUsername($username);
            $user->setPassword($this->passwordHasher->hashPassword($user, $password));
            $user->setEmail($email);
            $user->setRoles([$role]);

            $manager->persist($user);
            $this->addReference($username, $user);
        }

        $manager->flush();
    }

    /**
     * getUserData.
     *
     * @return array<int,array<int,string>>
     */
    private function getUserData(): array
    {
        return [
            // $userData = [$publicName, $username, $password, $email, $roles];
            ['Al Super', 'super', 'super', 'super@exemple.com', 'ROLE_SUPER_ADMIN'],
            ['Bob Admin', 'admin', 'admin', 'admin@exemple.com', 'ROLE_ADMIN'],
            ['Ush User', 'user', 'user', 'user@exemple.com', 'ROLE_USER'],
        ];
    }
}
