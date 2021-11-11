<?php

namespace App\Entity;

use App\Repository\HoursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HoursRepository::class)
 */
class Hours
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $hour;

    /**
     * @ORM\ManyToOne(targetEntity=Duration::class, inversedBy="hours")
     */
    private $duration;

    /**
     * @ORM\ManyToMany(targetEntity=Days::class, mappedBy="hours")
     */
    private $days;

    /**
     * @ORM\OneToMany(targetEntity=Rendezvous::class, mappedBy="hours")
     */
    private $rendezvouses;

    public function __construct()
    {
        $this->days = new ArrayCollection();
        $this->rendezvouses = new ArrayCollection();
    }

    public function __toString(): string
    {
        if ($this->hour instanceof \DateTime) {
            $stringValue = $this->hour->format('H:i');
        }

        return $stringValue .' - '. $this->duration;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHour(): ?\DateTimeInterface
    {
        return $this->hour;
    }

    public function setHour(\DateTimeInterface $hour): self
    {
        $this->hour = $hour;

        return $this;
    }

    public function getDuration(): ?Duration
    {
        return $this->duration;
    }

    public function setDuration(?Duration $duration): self
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * @return Collection|Days[]
     */
    public function getDays(): Collection
    {
        return $this->days;
    }

    public function addDay(Days $day): self
    {
        if (!$this->days->contains($day)) {
            $this->days[] = $day;
        }

        return $this;
    }

    public function removeDay(Days $day): self
    {
        $this->days->removeElement($day);

        return $this;
    }

    /**
     * @return Collection|Rendezvous[]
     */
    public function getRendezvouses(): Collection
    {
        return $this->rendezvouses;
    }

    public function addRendezvouse(Rendezvous $rendezvouse): self
    {
        if (!$this->rendezvouses->contains($rendezvouse)) {
            $this->rendezvouses[] = $rendezvouse;
            $rendezvouse->setHours($this);
        }

        return $this;
    }

    public function removeRendezvouse(Rendezvous $rendezvouse): self
    {
        if ($this->rendezvouses->removeElement($rendezvouse)) {
            // set the owning side to null (unless already changed)
            if ($rendezvouse->getHours() === $this) {
                $rendezvouse->setHours(null);
            }
        }

        return $this;
    }
}
