<?php

namespace App\Entity;

use App\Repository\ColaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColaRepository::class)
 */
class Cola
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25)
     */
    private $Descripcion;

    /**
     * @ORM\Column(type="integer")
     */
    private $TiempoAtencion;

    /**
     * @ORM\OneToMany(targetEntity=UserCola::class, mappedBy="IdCola")
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

    public function getDescripcion(): ?string
    {
        return $this->Descripcion;
    }

    public function setDescripcion(string $Descripcion): self
    {
        $this->Descripcion = $Descripcion;

        return $this;
    }

    public function getTiempoAtencion(): ?int
    {
        return $this->TiempoAtencion;
    }

    public function setTiempoAtencion(int $TiempoAtencion): self
    {
        $this->TiempoAtencion = $TiempoAtencion;

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
            $userCola->setIdCola($this);
        }

        return $this;
    }

    public function removeUserCola(UserCola $userCola): self
    {
        if ($this->userColas->removeElement($userCola)) {
            // set the owning side to null (unless already changed)
            if ($userCola->getIdCola() === $this) {
                $userCola->setIdCola(null);
            }
        }

        return $this;
    }
}
