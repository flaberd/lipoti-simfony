<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Lipoti\Shop\Core\Entity\User;
use Lipoti\Shop\User\Form\RegistrationDto;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class UserManager
{
    private PasswordHasherFactoryInterface $passwordHasherFactory;

    private EntityManagerInterface $em;

    public function __construct(PasswordHasherFactoryInterface $passwordHasherFactory, EntityManagerInterface $em)
    {
        $this->passwordHasherFactory = $passwordHasherFactory;
        $this->em = $em;
    }

    public function create(RegistrationDto $dto): User
    {
        $user = new User(
            $dto->getEmail(),
            ['ROLE_USER'],
            $this->getHashedPassword($dto->getPassword()),
            $dto->getFirstName(),
            $dto->getLastName()
        );
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function confirmEmail(User $user): void
    {
        $user->setEmaiConfirm(1);
        $this->em->persist($user);
        $this->em->flush();
    }

    public function setPassword(User $user, string $password): void
    {
        $user->setPassword($this->getHashedPassword($password));
        $this->em->persist($user);
        $this->em->flush();
    }

    public function changeEmail(User $user, string $email): void
    {
        $user->setEmail($email);
        $this->em->persist($user);
        $this->em->flush();
    }

    private function getHashedPassword(string $plainPassword): string
    {
        return $this->passwordHasherFactory->getPasswordHasher(User::class)
            ->hash($plainPassword)
            ;
    }
}
