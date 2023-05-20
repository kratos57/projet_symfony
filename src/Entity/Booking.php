<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Customer::class, inversedBy="bookings")
     */
    private $customer;

    /**
     * @ORM\ManyToOne(targetEntity=TravelPackage::class, inversedBy="bookings")
     */
    private $TravelPackage;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCustomer(): ?Customer
    {
        return $this->customer;
    }

    public function setCustomer(?Customer $customer): self
    {
        $this->customer = $customer;

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
