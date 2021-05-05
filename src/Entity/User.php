<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private int $id;

    /** @ORM\Column(type="string") */
    private string $username;

    /** @ORM\Column(type="string") */
    private string $password;

    public function __construct(string $username)
    {
        $this->id = \random_int(0, 10000);
        $this->username = $username;
        $this->password = '';
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function getPassword(): string
    {
        return $this->password;
    }
    
    public function setPassword(string $password, UserPasswordEncoderInterface $encoder): void
    {
        $this->password = $encoder->encodePassword($this, $password);
    }

    public function eraseCredentials(): void
    {
    }

    public function getSalt(): ?string
    {
        return null;
    }
}