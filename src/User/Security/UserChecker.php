<?php

declare(strict_types=1);

namespace Lipoti\Shop\User\Security;

use Lipoti\Shop\Core\Entity\User;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        //CHECK CONFIRM EMAIL ON LOGIN
//        if (!$user->getEmaiConfirm()) {
//            // the message passed to this exception is meant to be displayed to the user
//            throw new CustomUserMessageAccountStatusException('Your email not confirmed.');
//        }

        if ($user->getIsBlock()) {
            // the message passed to this exception is meant to be displayed to the user
            throw new CustomUserMessageAccountStatusException('Your user account blocked.');
        }
    }

    public function checkPostAuth(UserInterface $user): void
    {
        if (!$user instanceof User) {
            return;
        }

        // user account is expired, the user may be notified
//        if ($user->isExpired()) {
//            throw new AccountExpiredException('...');
//        }
    }
}
