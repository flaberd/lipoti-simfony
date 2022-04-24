<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Lipoti\Shop\Core\Manager\AdminManager;

class AdminFixtures extends Fixture
{
    private AdminManager $adminManager;

    public function __construct(AdminManager $adminManager)
    {
        $this->adminManager = $adminManager;
    }

    public function load(ObjectManager $manager): void
    {
        $this->adminManager->create('admin@mail.com', '123');
    }
}
