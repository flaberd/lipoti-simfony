<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Lipoti\Shop\Core\Manager\UserManager;
use Lipoti\Shop\User\Form\RegistrationDto;

class UserFixtures extends Fixture
{
    private UserManager $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $user = new RegistrationDto();
            $user->setEmail('notgoga' . $i . '@mount.he');
            $user->setPassword('123');
            $user->setFirstName('Grisha' . $i);
            $user->setLastName('Solovey' . $i);
            $user = $this->userManager->create($user);
            $this->addReference('user_post_owner_' . $i, $user);
        }
    }
}
