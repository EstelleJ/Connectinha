<?php

namespace App\Entity;

use App\Repository\ProductCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=ProductCategoryRepository::class)
 */
class ProductCategory {

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
	 * @ORM\OneToMany(targetEntity=Product::class, mappedBy="productCategory")
	 */
	private $products;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private ?string $slug;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $active;

	/**
	 * @ORM\ManyToMany(targetEntity=ProductSubcategory::class, inversedBy="productCategories")
	 */
	private $subcategories;

	#[Pure] public function __toString(): string {
		return $this->getName();
	}

	#[Pure] public function __construct() {
		$this->products = new ArrayCollection();
		$this->productSubcategories = new ArrayCollection();
		$this->subcategories = new ArrayCollection();
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

	/**
	 * @return Collection|Product[]
	 */
	public function getProducts(): Collection {
		return $this->products;
	}

	public function addProduct(Product $product): self {
		if (!$this->products->contains($product)) {
			$this->products[] = $product;
			$product->setProductCategory($this);
		}

		return $this;
	}

	public function removeProduct(Product $product): self {
		if ($this->products->removeElement($product)) {
			// set the owning side to null (unless already changed)
			if ($product->getProductCategory() === $this) {
				$product->setProductCategory(null);
			}
		}

		return $this;
	}

	public function getSlug(): ?string {
		return $this->slug;
	}

	public function setSlug(string $slug): self {
		$this->slug = $slug;

		return $this;
	}

	public function getActive(): ?bool {
		return $this->active;
	}

	public function setActive(bool $active): self {
		$this->active = $active;

		return $this;
	}

	/**
	 * @return Collection|ProductSubcategory[]
	 */
	public function getSubcategories(): Collection {
		return $this->subcategories;
	}

	public function addSubcategory(ProductSubcategory $subcategory): self {
		if (!$this->subcategories->contains($subcategory)) {
			$this->subcategories[] = $subcategory;
		}

		return $this;
	}

	public function removeSubcategory(ProductSubcategory $subcategory): self {
		$this->subcategories->removeElement($subcategory);

		return $this;
	}
}
