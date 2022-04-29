<?php

declare(strict_types=1);

namespace Lipoti\Shop\Core\Entity;

use Doctrine\ORM\Mapping as ORM;
use Lipoti\Shop\Common\Entity\Traits\IdentifiableEntityTrait;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class Admin implements UserInterface, PasswordAuthenticatedUserInterface
{
    use IdentifiableEntityTrait;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private string $email;

    /**
     * @var string[]
     * @ORM\Column(type="json")
     */
    private array $roles;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string", length=255)
     */
    private string $password;

    public function __construct(string $email, string $password)
    {
        $this->email = $email;
        $this->roles = ['ROLE_ADMIN'];
        $this->password = $password;
    }

    public function __toString()
    {
        return (string) $this->email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->email;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
