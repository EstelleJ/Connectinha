<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 */
class Product {

	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=255, unique=true)
	 */
	private ?string $name;


	/**
	 * @ORM\Column(type="text")
	 */
	private ?string $text;

	/**
	 * @ORM\OneToMany(targetEntity=ProductVariation::class, mappedBy="product")
	 */
	private $variations;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private ?string $slug;

	/**
	 * @ORM\ManyToOne(targetEntity=ProductCategory::class, inversedBy="products")
	 */
	private $productCategory;

	/**
	 * @ORM\ManyToOne(targetEntity=Tva::class, inversedBy="products")
	 */
	private $tva;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $active;

	/**
	 * @ORM\OneToMany(targetEntity=ProductImage::class, mappedBy="products", cascade={"persist", "remove"})
	 */
	private $productImages;

	/**
	 * @ORM\Column(type="datetime_immutable", options={"default":"CURRENT_TIMESTAMP"})
	 */
	private $created_at;

	/**
	 * @ORM\Column(type="datetime", options={"default":"CURRENT_TIMESTAMP"})
	 */
	private $updated_at;

	/**
	 * @ORM\ManyToMany(targetEntity=ProductSubcategory::class, inversedBy="products", fetch="EAGER")
	 */
	private $subcategory;

	/**
	 * @ORM\Column(type="text")
	 */
	private ?string $image;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $name_img;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $alt_img;

	/**
	 * @ORM\Column(type="float")
	 */
	private $price;

	/**
	 * @ORM\ManyToMany(targetEntity=PaymentMethod::class, inversedBy="products")
	 */
	private $payment_method;

    /**
     * @ORM\Column(type="boolean")
     */
    private $favourite;

    /**
     * @ORM\ManyToMany(targetEntity=MantraProducts::class, inversedBy="product", fetch="EAGER")
     */
    private $mantraProducts;

    /**
     * @ORM\Column(type="integer")
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity=SpecialOffer::class, inversedBy="products")
     */
    private $specialOffer;

	#[Pure] public function __toString(): string {
                                          		return $this->getName();
                                          	}

	#[Pure] public function __construct() {
                                          		$this->variations = new ArrayCollection();
                                          		$this->productImages = new ArrayCollection();
                                          		$this->created_at = new \DateTimeImmutable('now');
                                          		$this->subcategory = new ArrayCollection();
                                          		$this->payment_method = new ArrayCollection();
                                            $this->mantraProducts = new ArrayCollection();
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

	public function getText(): ?string {
                                          		return $this->text;
                                          	}

	public function setText(string $text): self {
                                          		$this->text = $text;
                                          
                                          		return $this;
                                          	}

	/**
	 * @return Collection|ProductVariation[]
	 */
	public function getVariations(): Collection {
                                          		return $this->variations;
                                          	}

	public function addVariation(ProductVariation $variation): self {
                                          		if (!$this->variations->contains($variation)) {
                                          			$this->variations[] = $variation;
                                          			$variation->setProduct($this);
                                          		}
                                          
                                          		return $this;
                                          	}

	public function removeVariation(ProductVariation $variation): self {
                                          		if ($this->variations->removeElement($variation)) {
                                          			// set the owning side to null (unless already changed)
                                          			if ($variation->getProduct() === $this) {
                                          				$variation->setProduct(null);
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

	public function getProductCategory(): ?ProductCategory {
                                          		return $this->productCategory;
                                          	}

	public function setProductCategory(?ProductCategory $productCategory): self {
                                          		$this->productCategory = $productCategory;
                                          
                                          		return $this;
                                          	}

	public function getTva(): ?Tva {
                                          		return $this->tva;
                                          	}

	public function setTva(?Tva $tva): self {
                                          		$this->tva = $tva;
                                          
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
	 * @return Collection|ProductImage[]
	 */
	public function getProductImages(): Collection {
                                          		return $this->productImages;
                                          	}

	public function addProductImage(ProductImage $productImage): self {
                                          		if (!$this->productImages->contains($productImage)) {
                                          			$this->productImages[] = $productImage;
                                          			$productImage->setProducts($this);
                                          		}
                                          
                                          		return $this;
                                          	}

	public function removeProductImage(ProductImage $productImage): self {
                                          		if ($this->productImages->removeElement($productImage)) {
                                          			// set the owning side to null (unless already changed)
                                          			if ($productImage->getProducts() === $this) {
                                          				$productImage->setProducts(null);
                                          			}
                                          		}
                                          
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

	/**
	 * @return Collection|ProductSubcategory[]
	 */
	public function getSubcategory(): Collection {
                                          		return $this->subcategory;
                                          	}

	public function addSubcategory(ProductSubcategory $subcategory): self {
                                          		if (!$this->subcategory->contains($subcategory)) {
                                          			$this->subcategory[] = $subcategory;
                                          		}
                                          
                                          		return $this;
                                          	}

	public function removeSubcategory(ProductSubcategory $subcategory): self {
                                          		$this->subcategory->removeElement($subcategory);
                                          
                                          		return $this;
                                          	}

	public function getImage(): ?string {
                                          		return $this->image;
                                          	}

	public function setImage(string $image): self {
                                          		$this->image = $image;
                                          
                                          		return $this;
                                          	}

	public function getNameImg(): ?string {
                                          		return $this->name_img;
                                          	}

	public function setNameImg(string $name_img): self {
                                          		$this->name_img = $name_img;
                                          
                                          		return $this;
                                          	}

	public function getAltImg(): ?string {
                                          		return $this->alt_img;
                                          	}

	public function setAltImg(string $alt_img): self {
                                          		$this->alt_img = $alt_img;
                                          
                                          		return $this;
                                          	}

	public function getPrice(): ?float {
                                          		return $this->price;
                                          	}

	public function setPrice(float $price): self {
                                          		$this->price = $price;
                                          
                                          		return $this;
                                          	}

	/**
	 * @return Collection|PaymentMethod[]
	 */
	public function getPaymentMethod(): Collection {
                                          		return $this->payment_method;
                                          	}

	public function addPaymentMethod(PaymentMethod $paymentMethod): self {
                                          		if (!$this->payment_method->contains($paymentMethod)) {
                                          			$this->payment_method[] = $paymentMethod;
                                          		}
                                          
                                          		return $this;
                                          	}

	public function removePaymentMethod(PaymentMethod $paymentMethod): self {
                                          		$this->payment_method->removeElement($paymentMethod);
                                          
                                          		return $this;
                                          	}

    public function getFavourite(): ?bool
    {
        return $this->favourite;
    }

    public function setFavourite(bool $favourite): self
    {
        $this->favourite = $favourite;

        return $this;
    }

    /**
     * @return Collection|MantraProducts[]
     */
    public function getMantraProducts(): Collection
    {
        return $this->mantraProducts;
    }

    public function addMantraProduct(MantraProducts $mantraProduct): self
    {
        if (!$this->mantraProducts->contains($mantraProduct)) {
            $this->mantraProducts[] = $mantraProduct;
            $mantraProduct->addProduct($this);
        }

        return $this;
    }

    public function removeMantraProduct(MantraProducts $mantraProduct): self
    {
        if ($this->mantraProducts->removeElement($mantraProduct)) {
            $mantraProduct->removeProduct($this);
        }

        return $this;
    }

    public function getWeight(): ?int
    {
        return $this->weight;
    }

    public function setWeight(int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getSpecialOffer(): ?SpecialOffer
    {
        return $this->specialOffer;
    }

    public function setSpecialOffer(?SpecialOffer $specialOffer): self
    {
        $this->specialOffer = $specialOffer;

        return $this;
    }
}
