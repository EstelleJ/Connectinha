<?php

namespace App\Entity;

use App\Repository\RendezvousRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RendezvousRepository::class)
 */
class Rendezvous {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="date")
	 */
	private $date;

	/**
	 * @ORM\ManyToOne(targetEntity=Duration::class, inversedBy="rendezvouses", fetch="EAGER")
	 */
	private $duration;

	/**
	 * @ORM\ManyToOne(targetEntity=Days::class, inversedBy="rendezvouses")
	 */
	private $day;

	/**
	 * @ORM\ManyToOne(targetEntity=Hours::class, inversedBy="rendezvouses", fetch="EAGER")
	 */
	private $hours;

	/**
	 * @ORM\ManyToOne(targetEntity=Services::class, inversedBy="rendezvouses")
	 */
	private $service;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private $firstname;

	/**
	 * @ORM\Column(type="string", length=128)
	 */
	private $email;

	/**
	 * @ORM\Column(type="string", length=16)
	 */
	private $phoneNumber;

	/**
	 * @ORM\Column(type="string", length=255, unique=true)
	 */
	private $token;

    /**
     * @ORM\Column(type="string", length=64, nullable=true)
     */
    private $status;

	public function getId(): ?int {
         		return $this->id;
         	}

	public function getDate(): ?\DateTimeInterface {
         		return $this->date;
         	}

	public function setDate(\DateTimeInterface $date): self {
         		$this->date = $date;
         
         		return $this;
         	}

	public function getDuration(): ?Duration {
         		return $this->duration;
         	}

	public function setDuration(?Duration $duration): self {
         		$this->duration = $duration;
         
         		return $this;
         	}

	public function getDay(): ?Days {
         		return $this->day;
         	}

	public function setDay(?Days $day): self {
         		$this->day = $day;
         
         		return $this;
         	}

	public function getHours(): ?Hours {
         		return $this->hours;
         	}

	public function setHours(?Hours $hours): self {
         		$this->hours = $hours;
         
         		return $this;
         	}

	public function getService(): ?Services {
         		return $this->service;
         	}

	public function setService(?Services $service): self {
         		$this->service = $service;
         
         		return $this;
         	}

	public function getName(): ?string {
         		return $this->name;
         	}

	public function setName(string $name): self {
         		$this->name = $name;
         
         		return $this;
         	}

	public function getFirstname(): ?string {
         		return $this->firstname;
         	}

	public function setFirstname(string $firstname): self {
         		$this->firstname = $firstname;
         
         		return $this;
         	}

	public function getEmail(): ?string {
         		return $this->email;
         	}

	public function setEmail(string $email): self {
         		$this->email = $email;
         
         		return $this;
         	}

	public function getPhoneNumber(): ?string {
         		return $this->phoneNumber;
         	}

	public function setPhoneNumber(string $phoneNumber): self {
         		$this->phoneNumber = $phoneNumber;
         
         		return $this;
         	}

	public function getToken(): ?string {
         		return $this->token;
         	}

	public function setToken(string $token): self {
         		$this->token = $token;
         
         		return $this;
         	}

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }
}
