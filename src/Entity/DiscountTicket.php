<?php

namespace App\Entity;

use App\Repository\DiscountTicketRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DiscountTicketRepository::class)
 */
class DiscountTicket
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $code;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=0, nullable=true)
     */
    private $amount;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $percent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAmount(): ?string
    {
        return $this->amount;
    }

    public function setAmount(string $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    public function getPercent(): ?int
    {
        return $this->percent;
    }

    public function setPercent(int $percent): self
    {
        $this->percent = $percent;

        return $this;
    }
}
