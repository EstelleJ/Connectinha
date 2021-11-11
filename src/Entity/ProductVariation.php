<?php

namespace App\Entity;

use App\Repository\ProductVariationRepository;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=ProductVariationRepository::class)
 */
class ProductVariation {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private ?string $name;

	/**
	 * @ORM\Column(type="integer", nullable=true)
	 */
	private ?int $price;

	/**
	 * @ORM\Column(type="text", nullable=true)
	 */
	private ?string $text;

	/**
	 * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="variations")
	 */
	private $product;

	#[Pure] public function __toString(): string {
		return $this->getName();
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function setName(?string $name): self {
		$this->name = $name;

		return $this;
	}

	public function getPrice(): ?int {
		return $this->price;
	}

	public function setPrice(?int $price): self {
		$this->price = $price;

		return $this;
	}

	public function getText(): ?string {
		return $this->text;
	}

	public function setText(?string $text): self {
		$this->text = $text;

		return $this;
	}

	public function getProduct(): ?Product {
		return $this->product;
	}

	public function setProduct(?Product $product): self {
		$this->product = $product;

		return $this;
	}
}
