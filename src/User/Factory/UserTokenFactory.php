<?php


namespace Lipoti\Shop\User\Factory;


use Lipoti\Shop\Core\Entity\User;
use Lipoti\Shop\Core\Entity\UserToken;

class UserTokenFactory
{
    private const HASH_ENTROPY = 32;

    public function create(string $type, User $user): UserToken
    {
        $hash = $this->generateHash();

        return new UserToken($user, $hash, $type);
    }

    private function generateHash(): string
    {
        $bytes = random_bytes(self::HASH_ENTROPY);

        return rtrim(strtr(base64_encode($bytes), '+/', '-_'), '=');
    }
}