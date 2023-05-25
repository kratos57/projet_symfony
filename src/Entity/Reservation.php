<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReservationRepository::class)
 */
class Reservation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity=TravelPackage::class, inversedBy="reservations")
     * @ORM\JoinColumn(nullable=false)
     */
    private $TravelPackage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getTravelPackage(): ?TravelPackage
    {
        return $this->TravelPackage;
    }

    public function setTravelPackage(?TravelPackage $TravelPackage): self
    {
        $this->TravelPackage = $TravelPackage;

        return $this;
    }
}
