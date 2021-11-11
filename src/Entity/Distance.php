<?php

namespace App\Entity;

use App\Repository\DistanceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=DistanceRepository::class)
 */
class Distance {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $title;

	/**
	 * @ORM\Column(type="string", length=16)
	 */
	private $duration;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $unity;

	/**
	 * @ORM\OneToMany(targetEntity=Services::class, mappedBy="distance", cascade={"persist"})
	 */
	private $services;

	public function __construct() {
		$this->services = new ArrayCollection();
	}

	#[Pure] public function __toString(): string {
		return $this->getTitle();
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getTitle(): ?string {
		return $this->title;
	}

	public function setTitle(string $title): self {
		$this->title = $title;

		return $this;
	}

	public function getDuration(): ?string {
		return $this->duration;
	}

	public function setDuration(string $duration): self {
		$this->duration = $duration;

		return $this;
	}

	public function getUnity(): ?string {
		return $this->unity;
	}

	public function setUnity(string $unity): self {
		$this->unity = $unity;

		return $this;
	}

	/**
	 * @return Collection|Services[]
	 */
	public function getServices(): Collection {
		return $this->services;
	}

	public function addService(Services $service): self {
		if (!$this->services->contains($service)) {
			$this->services[] = $service;
			$service->setDistance($this);
		}

		return $this;
	}

	public function removeService(Services $service): self {
		if ($this->services->removeElement($service)) {
			// set the owning side to null (unless already changed)
			if ($service->getDistance() === $this) {
				$service->setDistance(null);
			}
		}

		return $this;
	}
}
