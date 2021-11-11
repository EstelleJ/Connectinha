<?php

namespace App\Entity;

use App\Repository\ProductImageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity(repositoryClass=ProductImageRepository::class)
 */
class ProductImage {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private ?string $name;

	/**
	 * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="productImages")
	 */
	private $products;

	/**
	 * @ORM\ManyToMany(targetEntity=ProductColor::class, inversedBy="productImages")
	 */
	private $colors;

	/**
	 * @ORM\Column(type="text", nullable=false)
	 */
	private ?string $image;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $title;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $alt;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $text;

	/**
	 * @ORM\Column(type="datetime_immutable", options={"default":"CURRENT_TIMESTAMP"})
	 */
	private $created_at;

	/**
	 * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
	 */
	private $updated_at;

	#[Pure] public function __toString(): string {
		return $this->getName();
	}

	#[Pure] public function __construct() {
		$this->productColors = new ArrayCollection();
		$this->colors = new ArrayCollection();
		$this->created_at = new \DateTimeImmutable('now');
	}

	public function getId(): ?int {
		return $this->id;
	}

	public function getName(): ?string {
		return $this->name;
	}

	public function setName(string $name): self {
		$this->name = $name;

		return $this;
	}

	public function getProducts(): ?Product {
		return $this->products;
	}

	public function setProducts(?Product $products): self {
		$this->products = $products;

		return $this;
	}

	/**
	 * @return Collection|ProductColor[]
	 */
	public function getColors(): Collection {
		return $this->colors;
	}

	public function addColor(ProductColor $color): self {
		if (!$this->colors->contains($color)) {
			$this->colors[] = $color;
		}

		return $this;
	}

	public function removeColor(ProductColor $color): self {
		$this->colors->removeElement($color);

		return $this;
	}

	public function getImage(): ?string {
		return $this->image;
	}

	public function setImage(?string $image): self {
		$this->image = $image;

		return $this;
	}

	public function getTitle(): ?string {
		return $this->title;
	}

	public function setTitle(string $title): self {
		$this->title = $title;

		return $this;
	}

	public function getAlt(): ?string {
		return $this->alt;
	}

	public function setAlt(string $alt): self {
		$this->alt = $alt;

		return $this;
	}

	public function getText(): ?string {
		return $this->text;
	}

	public function setText(string $text): self {
		$this->text = $text;

		return $this;
	}

	public function getCreatedAt(): ?\DateTimeImmutable {
		return $this->created_at;
	}

	public function setCreatedAt(): self {
		$this->created_at = new \DateTimeImmutable('now');

		return $this;
	}

	public function getUpdatedAt(): ?\DateTimeInterface {
		return $this->updated_at;
	}

	public function setUpdatedAt(\DateTimeInterface $updated_at): self {
		$this->updated_at = $updated_at;

		return $this;
	}
}
