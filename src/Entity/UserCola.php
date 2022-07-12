<?php

namespace App\Entity;

use App\Repository\UserColaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserColaRepository::class)
 * * @ORM\HasLifecycleCallbacks()<
 */
class UserCola
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="userColas")
     */
    private $IdUser;

    /**
     * @ORM\ManyToOne(targetEntity=Cola::class, inversedBy="userColas")
     */
    private $IdCola;

    /**
     * @ORM\Column(type="datetime")
     */
    private $FechaHora;


        /**
    * @ORM\PrePersist
    */
    public function setCreatedFechaHora()
    {
        $this->FechaHora = new \DateTime();    
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdUser(): ?User
    {
        return $this->IdUser;
    }

    public function setIdUser(?User $IdUser): self
    {
        $this->IdUser = $IdUser;

        return $this;
    }

    public function getIdCola(): ?Cola
    {
        return $this->IdCola;
    }

    public function setIdCola(?Cola $IdCola): self
    {
        $this->IdCola = $IdCola;

        return $this;
    }

    public function getFechaHora(): ?\DateTimeInterface
    {
        return $this->FechaHora;
    }

    public function setFechaHora(\DateTimeInterface $FechaHora): self
    {
        $this->FechaHora = $FechaHora;

        return $this;
    }
}
