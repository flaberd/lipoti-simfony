<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Lipoti\Shop\Core\Entity\Admin;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class AdminManager
{
    private PasswordHasherFactoryInterface $passwordHasherFactory;

    private EntityManagerInterface $em;

    public function __construct(PasswordHasherFactoryInterface $passwordHasherFactory, EntityManagerInterface $em)
    {
        $this->passwordHasherFactory = $passwordHasherFactory;
        $this->em = $em;
    }

    public function create(string $email, string $pass): Admin
    {
        $user = new Admin(
            $email,
            $this->getHashedPassword($pass),
        );
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    private function getHashedPassword(string $plainPassword): string
    {
        return $this->passwordHasherFactory->getPasswordHasher(Admin::class)
            ->hash($plainPassword)
            ;
    }
}
