<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`user`")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     */
    private $Nombre;

    /**
     * @ORM\OneToMany(targetEntity=UserCola::class, mappedBy="IdUser")
     */
    private $userColas;

    public function __construct()
    {
        $this->userColas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * @return Collection<int, UserCola>
     */
    public function getUserColas(): Collection
    {
        return $this->userColas;
    }

    public function addUserCola(UserCola $userCola): self
    {
        if (!$this->userColas->contains($userCola)) {
            $this->userColas[] = $userCola;
            $userCola->setIdUser($this);
        }

        return $this;
    }

    public function removeUserCola(UserCola $userCola): self
    {
        if ($this->userColas->removeElement($userCola)) {
            // set the owning side to null (unless already changed)
            if ($userCola->getIdUser() === $this) {
                $userCola->setIdUser(null);
            }
        }

        return $this;
    }
}
