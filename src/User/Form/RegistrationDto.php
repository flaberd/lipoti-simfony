<?php

declare(strict_types=1);

namespace Lipoti\Shop\User\Form;

use Lipoti\Shop\Core\Entity\User;
use Lipoti\Shop\Core\Validator\Constraints\UniqueDTOProperty;
use Symfony\Component\Validator\Constraints as Assert;

class RegistrationDto
{
    /**
     * @Assert\NotBlank
     * @Assert\Email(
     *     message="The email '{{ value }}' is not a valid email."
     * )
     * @UniqueDTOProperty(entityClass=User::class, entityProperty="email", message="This email is already used")
     */
    private string $email;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=8,
     *     max=50,
     *     minMessage="Your password must be at least {{ limit }} characters long",
     *     maxMessage="Your password cannot be longer than {{ limit }} characters"
     * )
     */
    private string $password;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Your first name must be at least {{ limit }} characters long",
     *     maxMessage="Your first name cannot be longer than {{ limit }} characters"
     * )
     */
    private string $firstName;

    /**
     * @Assert\NotBlank
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Your last name must be at least {{ limit }} characters long",
     *     maxMessage="Your last name cannot be longer than {{ limit }} characters"
     * )
     */
    private string $lastName;

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): void
    {
        $this->lastName = $lastName;
    }
}
