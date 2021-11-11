<?php

namespace App\Entity;

use App\Repository\UnavailableRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UnavailableRepository::class)
 */
class Unavailable {

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

	public function getDateStringWithoutYear(): string {
		return $this->date->format('-m-d');
	}
}
