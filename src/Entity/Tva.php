<?php

namespace App\Entity;

use App\Repository\TvaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JetBrains\PhpStorm\Pure;

/**
 * @ORM\Entity(repositoryClass=TvaRepository::class)
 */
class Tva {

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
	 * @ORM\OneToMany(targetEntity=Product::class, mappedBy="tva")
	 */
	private $products;

	/**
	 * @ORM\Column(type="integer")
	 */
	private $percentage;

    /**
     * @ORM\OneToMany(targetEntity=Services::class, mappedBy="tva")
     */
    private $prestations;

	#[Pure] public function __construct() {
               		$this->products = new ArrayCollection();
                 $this->prestations = new ArrayCollection();
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

	/**
	 * @return Collection
	 */
	public function getProducts(): Collection {
               		return $this->products;
               	}

	public function addProduct(Product $product): self {
               		if (!$this->products->contains($product)) {
               			$this->products[] = $product;
               			$product->setTva($this);
               		}
               
               		return $this;
               	}

	public function removeProduct(Product $product): self {
               		if ($this->products->removeElement($product)) {
               			// set the owning side to null (unless already changed)
               			if ($product->getTva() === $this) {
               				$product->setTva(null);
               			}
               		}
               
               		return $this;
               	}

	public function getPercentage(): ?int {
               		return $this->percentage;
               	}

	public function setPercentage(int $percentage): self {
               		$this->percentage = $percentage;
               
               		return $this;
               	}

    /**
     * @return Collection|Services[]
     */
    public function getPrestations(): Collection
    {
        return $this->prestations;
    }

    public function addPrestation(Services $prestation): self
    {
        if (!$this->prestations->contains($prestation)) {
            $this->prestations[] = $prestation;
            $prestation->setTva($this);
        }

        return $this;
    }

    public function removePrestation(Services $prestation): self
    {
        if ($this->prestations->removeElement($prestation)) {
            // set the owning side to null (unless already changed)
            if ($prestation->getTva() === $this) {
                $prestation->setTva(null);
            }
        }

        return $this;
    }
}
