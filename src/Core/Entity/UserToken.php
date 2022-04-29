<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lipoti\Shop\Common\Entity\Traits\IdentifiableEntityTrait;
use Lipoti\Shop\Common\Entity\Traits\TimestampableEntityTrait;
use Lipoti\Shop\Core\Repository\UserTokenRepository;

/**
 * @ORM\Entity(repositoryClass=UserTokenRepository::class)
 */
class UserToken
{
    use IdentifiableEntityTrait;
    use TimestampableEntityTrait;

    public const TYPE_CONFIRM_REGISTRATION = 'activation';
    public const TYPE_EMAIL_CHANGE = 'email_change';
    public const TYPE_CONFIRM_RESET_PASSWORD = 'reset_password';
    public const TYPE_CONFIRM_IMPORT_DETAIL = 'import_detail';

    /**
     * @ORM\ManyToOne(targetEntity="Lipoti\Shop\Core\Entity\User")
     */
    private User $user;

    /**
     * @ORM\Column(type="string", unique=true, length=255)
     */
    private string $hash;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $type;

    public function __construct(User $user, string $hash, string $type)
    {
        $this->user = $user;
        $this->hash = $hash;
        $this->type = $type;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function getHash(): string
    {
        return $this->hash;
    }

    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $days // example "-1 days"
     */
    public function isExpired(string $days): bool
    {
        $date = new \DateTime();
        $date->modify($days);

        return $this->createdAt < $date;
    }
}
