<?php

/*
 * This file is part of the mazarini/dev project.
 *
 * (c) Mazarini <mazarini@protonmail.com.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mazarini\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mazarini\ToolsBundle\Entity\Entity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class User extends Entity implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * $email.
     *
     * @var string
     */
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    protected string $email = '';

    /**
     * $roles.
     *
     * @var array<int,string>
     */
    #[ORM\Column(type: 'json')]
    protected array $roles = [];

    /**
     * $name.
     *
     * @var string
     */
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    protected string $name = '';

    /**
     * $password.
     *
     * @var string
     */
    #[ORM\Column(type: 'string')]
    protected string $password = '';

    /**
     * getEmail.
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * setEmail.
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

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
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * setRoles.
     *
     * @param array<int,string> $roles
     */
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
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }
}
