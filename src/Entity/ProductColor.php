<?php

namespace App\Entity;

use App\Repository\ProductColorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=ProductColorRepository::class)
 */
class ProductColor {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=64)
	 */
	private ?string $name;

	/**
	 * @ORM\Column(type="string", length=16)
	 */
	private ?string $hexa;

	/**
	 * @ORM\ManyToOne(targetEntity=ProductImage::class, inversedBy="productColors")
	 */
	private $image;

	/**
	 * @ORM\ManyToMany(targetEntity=ProductImage::class, mappedBy="colors")
	 */
	private $productImages;

	public function __construct() {
		$this->productImages = new ArrayCollection();
	}

	#[Pure] public function __toString(): string {
		return $this->getName();
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

	public function getHexa(): ?string {
		return $this->hexa;
	}

	public function setHexa(string $hexa): self {
		$this->hexa = $hexa;

		return $this;
	}

	public function getImage(): ?ProductImage {
		return $this->image;
	}

	public function setImage(?ProductImage $image): self {
		$this->image = $image;

		return $this;
	}

	/**
	 * @return Collection|ProductImage[]
	 */
	public function getProductImages(): Collection {
		return $this->productImages;
	}

	public function addProductImage(ProductImage $productImage): self {
		if (!$this->productImages->contains($productImage)) {
			$this->productImages[] = $productImage;
			$productImage->addColor($this);
		}

		return $this;
	}

	public function removeProductImage(ProductImage $productImage): self {
		if ($this->productImages->removeElement($productImage)) {
			$productImage->removeColor($this);
		}

		return $this;
	}
}
