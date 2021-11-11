<?php

namespace App\Entity;

use App\Repository\ProductSubcategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=ProductSubcategoryRepository::class)
 */
class ProductSubcategory {

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
	 * @ORM\Column(type="string", length=255)
	 */
	private ?string $slug;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $active;

	/**
	 * @ORM\ManyToMany(targetEntity=ProductCategory::class, mappedBy="subcategories")
	 */
	private $productCategories;

	/**
	 * @ORM\ManyToMany(targetEntity=Product::class, mappedBy="subcategory", cascade={"all"}, orphanRemoval=true)
	 */
	private $products;

	public function __construct() {
		$this->productCategories = new ArrayCollection();
		$this->products = new ArrayCollection();
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
	 * @return Collection
	 */
	public function getProductCategories(): Collection {
		return $this->productCategories;
	}

	public function addProductCategory(ProductCategory $productCategory): self {
		if (!$this->productCategories->contains($productCategory)) {
			$this->productCategories[] = $productCategory;
			$productCategory->addSubcategory($this);
		}

		return $this;
	}

	public function removeProductCategory(ProductCategory $productCategory): self {
		if ($this->productCategories->removeElement($productCategory)) {
			$productCategory->removeSubcategory($this);
		}

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
			$product->addSubcategory($this);
		}

		return $this;
	}

	public function removeProduct(Product $product): self {
		if ($this->products->removeElement($product)) {
			$product->removeSubcategory($this);
		}

		return $this;
	}
}
